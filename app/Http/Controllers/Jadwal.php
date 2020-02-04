<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class Jadwal extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipeBus = \App\TipeBus::select('id', 'nama')->get();

        $ruteBus = DB::table('pivot_bus_rutes')
                    ->join('bus', 'pivot_bus_rutes.id_bus','=', 'bus.id')
                    ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
                    ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
                    ->select('pivot_bus_rutes.id', 'bus.nama', 'rutes.rute', 'tipebus.nama as tipebus')
                    ->get();
        // return $ruteBus;

        return view('admin.jadwal');
    }

    public function tipe($filter)
    {
        if($filter == 'tipe') {
            $data = \App\TipeBus::select('id', 'nama')->get();
        } else if($filter == 'rute') {
            $data = \App\Rute::select('id', 'rute')->get();
        } else if($filter == 'bus') {
            $data = \App\Bus::select('id', 'nama')->get();
        } else {
            exit();
        }

        return $data;
    }

    public function showRutePerjalanan($id)
    {

    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = \App\Jadwal();
        // $data->
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
