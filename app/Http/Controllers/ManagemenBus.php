<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ManagemenBus extends Controller
{

    public function index()
    {

        $pivotBusRute = DB::table('pivot_bus_rutes')
                    ->join('bus', 'bus.id', '=', 'pivot_bus_rutes.id_bus')
                    ->join('rutes', 'rutes.id', '=', 'pivot_bus_rutes.id_rute')
                    ->join('tipebus', 'tipebus.id', '=', 'bus.id_tipebus')
                    ->select('pivot_bus_rutes.harga', 'bus.nama as nama_bus', 'rutes.rute as rute_bus', 'bus.deskripsi', 'tipebus.nama')
                    ->get();
                    
        $test = DB::table('pivot_bus_rutes')
                        ->select('bus.nama', DB::raw('count(pivot_bus_rutes.id_bus) as jml'))
                        ->rightJoin('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
                        ->groupBy('bus.nama')
                        ->having('jml', '!=', 3)
                        ->get();
        // return $test;
        return view('admin.managemenbus');
    }

    public function data()
    {
        return view('admin.databus');
    }

    public function create()
    {
    }

    public function storeTipeBus(Request $request)
    {
        $data = new \App\Tipebus();
        $data->nama = $request->nama;
        $data->save();

        return $arrayName = array('status' => 'OK', 'code' => 200, 'message' => 'Berhasil Menambah Data');
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

        return $arrayName = array('status' => 'OK', 'code' => 200, 'message' => 'Berhasil Menambah Data');
    }

    public function storePivotBusRute(Request $request)
    {
        $data = new \App\PivotBusRute();
        $data->id_bus = $request->id_bus;
        $data->id_rute = $request->id_rute;
        $data->harga  = $request->harga;
        $data->save();

        return $arrayName = array('status' => 'OK', 'code' => 200, 'message' => 'Berhasil Menambah Data');
    }

    public function show($id)
    {
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
