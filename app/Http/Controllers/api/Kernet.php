<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class Kernet extends Controller
{
    public function scan($order_code)
    {
    	$data = DB::table('transaksis')
            ->join('users', 'transaksis.id_customer', '=', 'users.id')
            ->join('jadwals', 'transaksis.id_jadwal', '=', 'jadwals.id')
            ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
            ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
            ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
            ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
            ->select('transaksis.id as transaksi_id', 'transaksis.order_code', 'transaksis.barcode', 'users.id as user_id','users.name', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'pivot_bus_rutes.harga', 'transaksis.no_kursi', 'transaksis.status_bayar')
            ->where('transaksis.order_code', $order_code)
            ->get();

            return response()->json([
                'status' => true, 
                'message' => 'Data Tiket', 
                'code' => 200, 
                'data' => $data
            ]);
    }

    public function verif($id)
    {
    	$data = \App\Transaksi::find($id);
    	$data->trip = 'y';
    	$data->save();
    	
            return response()->json([
                'status' => true, 
                'message' => 'Berhasil Verifikasi Tiket', 
                'code' => 200
            ]);
    }
}
