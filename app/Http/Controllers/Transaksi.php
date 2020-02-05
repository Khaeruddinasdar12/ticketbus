<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class Transaksi extends Controller
{
    public function index()
    {
    	$belum = DB::table('transaksis')
    			->join('users', 'transaksis.id_customer', '=', 'users.id')
    			->join('jadwal', 'transaksis.id_jadwal', '=', 'jadwals.id')
    			->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
    			->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
    			->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
    			->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
    			->select('order_code', 'users.name as customer', '')
    			->where('transaksis.status_bayar', 'belum')
    			->get();

        return view('admin.transaksi');
    }

    public function riwayat()
    {
        return view('admin.riwayatperjalanan');
    }
}
