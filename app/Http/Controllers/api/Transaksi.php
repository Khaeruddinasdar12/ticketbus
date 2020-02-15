<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class Transaksi extends Controller
{
    public function cekKursi($id) // cek kursi berdasarkan id jadwal
    {
        $data = \App\Kursi::where('id_jadwal', $id)->get();

        return response()->json([
                'status'    => true, 
                'message'   => 'Cek kursi', 
                'code'      => 201, 
                'data'      => $data
            ]);
    }

    public function store(Request $request) // bertransaksi di android
    {
        $data = new \App\Transaksi();
        $data->id_jadwal = $request->id_jadwal;
        $data->id_customer = $request->id_customer;
        $data->status_bayar = 'belum';
        $data->no_kursi = $request->no_kursi;
        $data->trip = 'n';

        $order_code = \Carbon\Carbon::now() . 'id' . $request->id_jadwal;

        $data->order_code = $order_code;
        $data->save();

        //ubah status di tabel kursis
        $set_kursis = \App\Kursi::where('id_jadwal', $request->id_jadwal)->where('kursi', $request->no_kursi)
            ->update([
                'status' => 'terisi',
            ]);
        //end ubah status di tabel kursis
        return response()->json([
                'status' => true, 
                'message' => 'Transaksi berhasil', 
                'code' => 201
            ]);
    }

    public function list_belum_bayar($id) // menampilkan list transaksi yang belum di bayar berdasarkan id user
    {

    }

    public function buktiStore($id) // menginput bukti transfer berdasarkan id transaksi
    {
       
    }

    public function tiket($id) // menampilkan tiket user berdasarkan id user
    {
        
    }

    public function cek_transaksi($id) // menampilkan semua status transaksi berdasarkan id user
    {
        # code...
    }
    public function riwayat($id) //riwayat transaksi user
    {
        $data = DB::table('transaksis')
            ->join('users', 'transaksis.id_customer', '=', 'users.id')
            ->join('jadwals', 'transaksis.id_jadwal', '=', 'jadwals.id')
            ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
            ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
            ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
            ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
            ->select('transaksis.id as transaksi_id', 'transaksis.order_code', 'transaksis.barcode', 'users.id as user_id','users.name', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'pivot_bus_rutes.harga', 'transaksis.no_kursi', 'transaksis.status_bayar')
            ->where('transaksis.status_bayar', 'sudah')
            ->where('users.id', $id)
            ->get();

            return response()->json([
                'status' => true, 
                'message' => 'Riwayat Transaksi', 
                'code' => 201, 
                'data' => $data
            ]);
    }

    

    
}
