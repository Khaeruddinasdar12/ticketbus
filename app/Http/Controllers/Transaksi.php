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
    			->join('jadwals', 'transaksis.id_jadwal', '=', 'jadwals.id')
    			->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
    			->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
    			->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
    			->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
    			->join('kursis', 'bus.id', 'kursis.id_bus')
    			->select('order_code', 'users.name as customer', 'transaksis.no_kursi', 'jadwals.tanggal',
    					'jadwals.jam', 'bus.nama as nama_bus', 'rutes.rute', 'tipebus.nama as tipebus', 'kursis.status')
    			->where('transaksis.status_bayar', 'belum')
    			->where('kursis.kursi', 'transaksis.no_kursi')
    			->get();
    	return $belum;
        return view('admin.transaksi');
    }

    public function riwayat()
    {
        return view('admin.riwayatperjalanan');
    }
}
