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
                'status' => 'keranjang',
            ]);
        //end ubah status di tabel kursis
        return response()->json([
                'status' => true, 
                'message' => 'Transaksi berhasil', 
                'code' => 201,
                'data' => $data
            ]);
    }

    public function list_belum_bayar($id) // menampilkan list transaksi yang belum di bayar berdasarkan id user
    {
        $data = DB::table('transaksis')
            ->join('users', 'transaksis.id_customer', '=', 'users.id')
            ->join('jadwals', 'transaksis.id_jadwal', '=', 'jadwals.id')
            ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
            ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
            ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
            ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
            ->select('transaksis.id as transaksi_id', 'transaksis.order_code', 'transaksis.barcode', 'users.id as user_id','users.name', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'pivot_bus_rutes.harga', 'transaksis.no_kursi', 'transaksis.status_bayar')
            ->where('transaksis.status_bayar', 'belum')
            ->where('users.id', $id)
            ->get();

            return response()->json([
                'status' => true, 
                'message' => 'List transaksi belum dibayar', 
                'code' => 201,
                'data' => $data
            ]);
    }

    public function buktiStore(Request $request, $id) // menginput bukti transfer berdasarkan id transaksi
    {
        $data = \App\Transaksi::find($id);
            // Upload Foto Bukti Transfer
                $bukti = $request->file('bukti');
                if($bukti) {
                    if($data->bukti_transfer && file_exists(storage_path('app/public/' . $data->bukti_transfer))) { 
                    \Storage::delete('public/'. $data->bukti_transfer);
                    }
                    $bukti_path = $bukti->store('bukti', 'public');
                    $data->bukti_transfer = $bukti_path;
                }
            // End Upload Foto Bukti Transfer
        $data->status_bayar = 'proses_admin';
        $data->save();

        $kursi = \App\Kursi::where('id_jadwal', $data->id_jadwal)->where('kursi', $data->no_kursi)
            ->update([
                'status' => 'terisi',
            ]);

            return response()->json([
                'status' => true, 
                'message' => 'upload bukti transfer berhasil', 
                'code' => 201
            ]);

    }

    public function tiket($id) // menampilkan tiket user berdasarkan id user
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
            ->where('trip', 'n')
            ->where('users.id', $id)
            ->get();

            return response()->json([
                'status' => true, 
                'message' => 'Semua Tiket', 
                'code' => 201, 
                'data' => $data
            ]);
    }

    public function cek_transaksi($id) // menampilkan semua status transaksi berdasarkan id user
    {
        $data = DB::table('transaksis')
            ->join('users', 'transaksis.id_customer', '=', 'users.id')
            ->join('jadwals', 'transaksis.id_jadwal', '=', 'jadwals.id')
            ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
            ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
            ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
            ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
            ->select('transaksis.id as transaksi_id', 'transaksis.order_code', 'transaksis.barcode', 'users.id as user_id','users.name', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'pivot_bus_rutes.harga', 'transaksis.no_kursi', 'transaksis.status_bayar')
            ->where('users.id', $id)
            ->get();

            return response()->json([
                'status' => true, 
                'message' => 'Semua Transaksi', 
                'code' => 200, 
                'data' => $data
            ]);
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
            ->where('trip', 'y')
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
