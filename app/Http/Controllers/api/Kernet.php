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

    public function jadwal() //menampilkan semua data jadwal yang belum berangkat
    {
        $data = DB::table('jadwals')
              ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
              ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
              ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
              ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
              ->rightJoin('kursis', 'jadwals.id', 'kursis.id_jadwal')
              ->select('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'jadwals.status', 'pivot_bus_rutes.harga', DB::raw('count(case when kursis.status = "kosong" then 1 end)as kursi_kosong'))
              ->where('jadwals.status', 'belum')
              ->groupBy('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus', 'jadwals.status', 'pivot_bus_rutes.harga')
              ->get();

      return response()->json([
                'status' => true, 
                'message' => 'Data jadwal yang belum berangkat', 
                'code' => 200,
                'data' => $data
            ]);

    }

    public function perjalanan() // menampilkan halaman sedang/dalam perjalanan
    {
        $data = DB::table('jadwals')
          ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
          ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
          ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
          ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
          ->rightJoin('kursis', 'jadwals.id', 'kursis.id_jadwal')
          ->select('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'jadwals.status', 'pivot_bus_rutes.harga', DB::raw('count(case when kursis.status = "terisi" then 1 end)as kursi_terisi'))
          ->where('jadwals.status', 'perjalanan')
          ->groupBy('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus', 'jadwals.status', 'pivot_bus_rutes.harga')
          ->get();

       return response()->json([
                'status' => true, 
                'message' => 'Data jadwal yang dalam perjalanan', 
                'code' => 200,
                'data' => $data
            ]);
    }

    public function editStatus($status, $id) //mengubah status jadwal menjadi perjalanan atau selesai
      {
        $query = \App\Jadwal::findOrFail($id);
        if ($status == 'belum') {
          $query->status = 'perjalanan';
          $query->save();
          return response()->json([
                'status' => true, 
                'message' => 'Berhasil mengubah status menjadi berangkat', 
                'code' => 201
            ]);
        } else if ($status == 'sampai') {
          $query->status = 'selesai';
          $query->arrived_at = \Carbon\Carbon::now();
          $query->save();
          return response()->json([
                'status' => true, 
                'message' => 'Berhasil mengubah status menjadi selesai', 
                'code' => 201
            ]);
        } else {
          return response()->json([
                'status' => false, 
                'message' => 'Tidak ditemukan', 
                'code' => 404
            ]);
        }

        return $arrayName;
      }
}
