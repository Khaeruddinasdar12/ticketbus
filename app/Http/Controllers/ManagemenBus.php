<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ManagemenBus extends Controller
{

    public function index()
    {
        $showtipebus = \App\TipeBus::select('id', 'nama')->get();
        return view('admin.managemenbus', ['tipebus' => $showtipebus]);
    }

    public function pivot()
    {
        $showtipebus = \App\TipeBus::select('id', 'nama')->get();

        $countbus = \App\Bus::count();
        $showrute = DB::table('pivot_bus_rutes')
            ->select('rutes.rute', 'rutes.id',  DB::raw('count(pivot_bus_rutes.id_rute) as jml'))
            ->rightJoin('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
            ->groupBy('rutes.rute')
            ->groupBy('rutes.id')
            ->having('jml', '!=', $countbus)
            ->get();

        return view('admin.pivotbus', ['tipebus' => $showtipebus, 'rute' => $showrute]);
    }

    public function showBus($id) // event onchange di pivotbus.blade
    {
        $countrute = \App\Rute::count();

        $showbus = DB::table('pivot_bus_rutes')
            ->select('bus.id', 'bus.nama', DB::raw('count(pivot_bus_rutes.id_bus) as jml'))
            ->rightJoin('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
            ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
            ->where('bus.id_tipebus', '=', $id)
            ->groupBy('bus.nama')
            ->groupBy('bus.id')
            ->having('jml', '!=', $countrute)
            ->get();
        return $showbus;
    }

    public function data()
    {
        $pivotBusRute = DB::table('pivot_bus_rutes')
            ->join('bus', 'bus.id', '=', 'pivot_bus_rutes.id_bus')
            ->join('rutes', 'rutes.id', '=', 'pivot_bus_rutes.id_rute')
            ->join('tipebus', 'tipebus.id', '=', 'bus.id_tipebus')
            ->select('pivot_bus_rutes.harga', 'bus.nama as nama_bus', 'rutes.rute as rute_bus', 'bus.deskripsi', 'tipebus.nama as tipebus')
            ->get();

        $bus = DB::table('bus')
            ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
            ->select('bus.id', 'bus.nama', 'bus.deskripsi', 'bus.jumlah_kursi', 'tipebus.id as id_tipebus', 'tipebus.nama as tipebus')
            ->get();

        $tipebus = \App\TipeBus::select('id', 'nama')->get();
        $rute = \App\Rute::select('id', 'rute')->get();

        return view('admin.databus', ['pivot' => $pivotBusRute, 'bus' => $bus, 'tipebus' => $tipebus, 'rute' => $rute]);
    }

    public function storeRute(Request $request)
    {
        $data = new \App\Rute();
        $data->rute = $request->rute;
        $data->save();

        return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Menambah Data');
    }

    public function storeTipeBus(Request $request)
    {
        $data = new \App\TipeBus();
        $data->nama = $request->nama;
        $data->save();

        return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Menambah Data');
    }

    public function storeBus(Request $request)
    {
        $data = new \App\Bus();
        $data->nama = $request->nama;
        $data->id_tipebus = $request->id_tipebus;
        $data->deskripsi = $request->deskripsi;
        $data->jumlah_kursi = $request->jumlah_kursi;
        $data->save();

        for ($i = 1; $i <= $request->jumlah_kursi; $i++) {
            DB::table('kursis')->insert([
                'id_bus' => $data->id,
                'kursi' => '' . $i,
                'status' => 'kosong'
            ]);
        }

        return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Menambah Data');
    }

    public function storePivotBusRute(Request $request)
    {
        $countData = DB::table('pivot_bus_rutes')
            ->where('id_bus', $request->id_bus)
            ->where('id_rute', $request->id_rute)
            ->count();
        if ($countData == 1) {
            return $arrayName = array('status' => 'error', 'pesan' => 'Data Sudah Ada');
        }

        $data = new \App\PivotBusRute();
        $data->id_bus = $request->id_bus;
        $data->id_rute = $request->id_rute;
        $data->harga  = $request->harga;
        $data->save();

        return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Menambah Data');
    }

    public function editBus(Request $request, $id)
    {
        $cek = \App\Kursi::where('id_bus', $id)->where('status', '!=', 'kosong')->count();
        if ($cek > 0) {
            return $arrayName = array('status' => 'error', 'pesan' => 'Terdapat kursi yang berstatus terisi');
        }
        $delete_kursi = \App\Kursi::where('id_bus', $id)->delete();

        for ($i = 1; $i <= $request->jumlah_kursi; $i++) {
            DB::table('kursis')->insert([
                'id_bus' => $id,
                'kursi' => '' . $i,
                'status' => 'kosong'
            ]);
        }

        $data =  \App\Bus::findOrFail($id);
        $data->nama = $request->nama;
        $data->id_tipebus = $request->id_tipebus;
        $data->deskripsi = $request->deskripsi;
        $data->jumlah_kursi = $request->jumlah_kursi;
        $data->save();

        return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Mengubah Data');
    }

    public function editRute(Request $request, $id)
    {
        $data = \App\Rute::findOrFail($id);
        $data->rute = $request->rute;
        $data->save();

        return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Mengubah Data');
    }

    public function editTipe(Request $request, $id)
    {
        $data = \App\TipeBus::findOrFail($id);
        $data->nama = $request->nama;
        $data->save();

        return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Mengubah Data');
    }

    public function deleteBus($id)
    {
        $cek = \App\PivotBusRute::where('id_bus', $id)->count();
        return $cek;
    }

    public function deleteTipe($id)
    {
        
    }

    public function deleteRute($id)
    {
        
    }
}
