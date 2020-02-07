<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ManagemenBus extends Controller
{

    public function index() //menampilkan halaman data bus
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

    public function create() //menampilkan halaman tambah bus
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
        $cek = DB::table('jadwals')
                ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
                ->where('pivot_bus_rutes.id_bus', $id)
                ->count();

        $data =  \App\Bus::findOrFail($id);

        if($cek > 0){
            $data->nama = $request->nama;
            $data->deskripsi = $request->deskripsi;
            $data->save();
            return $arrayName = array('status' => 'success', 'pesan' => 'Info! Bus ini telah beroperasi, hanya bisa mengubah nama bus');
        }

        
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
        if($cek > 0) {
            return $arrayName = array('status' => 'error', 'pesan' => 'Gagal! Data ini terdapat di tabel lain');
        }

        $data = \App\Bus::findOrFail($id);
        $data->delete();

        return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Menghapus Data');
    }

    public function deleteTipe($id)
    {
        $cek = \App\Bus::where('id_tipebus', $id)->count();
        if($cek > 0) {
            return $arrayName = array('status' => 'error', 'pesan' => 'Gagal! Data ini terdapat di tabel lain');
        }
        $data = \App\TipeBus::findOrFail($id);
        $data->delete();

        return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Menghapus Data');
    }

    public function deleteRute($id)
    {
        $cek = \App\PivotBusRute::where('id_rute', $id)->count();
        if($cek > 0) {
            return $arrayName = array('status' => 'error', 'pesan' => 'Gagal! Data ini terdapat di tabel lain');
        }
        $data = \App\Rute::findOrFail($id);
        $data->delete();

        return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Menghapus Data');
    }

    public function deletePivot($id)
    {
        $cek = \App\Jadwal::where('id_bus_rute', $id)->count();
        if($cek > 0) {
            return $arrayName = array('status' => 'error', 'pesan' => 'Gagal! Data ini terdapat di tabel lain');
        }
        $data = \App\PivotBusRute::findOrFail($id);
        $data->delete();

        return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Menghapus Data');
    }
}
