<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Jadwal extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() // menampilkan data jadwal
    {
        $data = DB::table('jadwals')
            ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
            ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
            ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
            ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
            ->rightJoin('kursis', 'jadwals.id', 'kursis.id_jadwal')
            ->select('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', DB::raw('count(case when kursis.status = "kosong" then 1 end)as kursi_kosong'))
            ->where('jadwals.status', 'belum')
            ->groupBy('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus')
            ->get();

        // return $data;
        return view('admin.datajadwal', ['data' => $data]);
    }

    public function create() //tambah jadwal
    {
        $tipeBus = \App\TipeBus::select('id', 'nama')->get();

        $ruteBus = DB::table('pivot_bus_rutes')
            ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
            ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
            ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
            ->select('pivot_bus_rutes.id', 'bus.nama', 'rutes.rute', 'tipebus.nama as tipebus')
            ->get();

        return view('admin.tambahjadwal');
    }

    public function riwayat() // menampilkan riwayat jadwal
    {
        $data = DB::table('jadwals')
            ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
            ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
            ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
            ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
            ->rightJoin('kursis', 'bus.id', 'kursis.id_bus')
            ->select('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'rutes.rute', 'tipebus.nama as tipebus', DB::raw('count(case when kursis.status = "kosong" then 1 end)as kursi_kosong'))
            ->where('jadwals.status', 'selesai')
            ->groupBy('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'namabus', 'bus.nama', 'rutes.rute', 'tipebus')
            ->get();
        return view('admin.riwayatjadwal');
    }

    public function tipe($filter)
    {
        if ($filter == 'tipe') {
            $data = \App\TipeBus::select('id', 'nama')->get();
        } else if ($filter == 'rute') {
            $data = \App\Rute::select('id', 'rute as nama')->get();
        } else {
            exit();
        }

        return $data;
    }

    public function showRutePerjalanan($tipe, $id)
    {
        if ($tipe == 'tipe') {
            $data = DB::table('pivot_bus_rutes')
                ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
                ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
                ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
                ->select('pivot_bus_rutes.id', 'bus.nama as data1', 'rutes.rute as data2', 'tipebus.nama as filter')
                ->where('tipebus.id', $id)
                ->get();
        } else if ($tipe == 'rute') {
            $data = DB::table('pivot_bus_rutes')
                ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
                ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
                ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
                ->select('pivot_bus_rutes.id', 'bus.nama as data1', 'rutes.rute as filter', 'tipebus.nama as data2')
                ->where('rutes.id', $id)
                ->get();
        } else {
            exit();
        }
        return $data;
    }

    public function store(Request $request) // menginput data jadwal
    {
        $id_bus = DB::table('pivot_bus_rutes')
            ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
            ->select('bus.jumlah_kursi')
            ->where('pivot_bus_rutes.id', $request->id_bus_rute)
            ->first();

        $data = new \App\Jadwal();
        $data->id_bus_rute = $request->id_bus_rute;
        $data->tanggal = $request->tanggal;
        $data->jam = $request->jam;
        $data->status = 'belum';
        $data->created_by = \Auth::user()->id;
        $data->save();

        for ($i = 1; $i <= $id_bus->jumlah_kursi; $i++) {
            DB::table('kursis')->insert([
                'id_jadwal' => $data->id,
                'kursi' => '' . $i,
                'status' => 'kosong'
            ]);
        }

        return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Menambah Data');
    }

    public function showDeskripsi($id)
    {
        $data = DB::table('pivot_bus_rutes')
            ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
            ->select('bus.deskripsi', 'pivot_bus_rutes.harga')
            ->where('pivot_bus_rutes.id', $id)
            // ->where('pivot_bus_rutes.id_bus', $id)
            ->get();
        return $data;
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
