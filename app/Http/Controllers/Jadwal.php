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

    public function index()
    {
        $tipeBus = \App\TipeBus::select('id', 'nama')->get();

        $ruteBus = DB::table('pivot_bus_rutes')
            ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
            ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
            ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
            ->select('pivot_bus_rutes.id', 'bus.nama', 'rutes.rute', 'tipebus.nama as tipebus')
            ->get();
        // return $ruteBus;

        return view('admin.jadwal');
    }

    public function create()
    {
        return view('admin.tambahjadwal');
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

    public function store(Request $request)
    {
        $data = new \App\Jadwal();
        $data->id_bus_rute = $request->id_bus_rute;
        $data->tanggal = $request->tanggal;
        $data->jam = $request->jam;
        $data->status = 'belum';
        $data->created_by = \Auth::user()->id;
        $data->save();

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
