<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class Transaksi extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	$data = DB::table('jadwals')
            ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
            ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
            ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
            ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
            ->rightJoin('kursis', 'jadwals.id', 'kursis.id_jadwal')
            ->select('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'pivot_bus_rutes.harga', DB::raw('count(case when kursis.status = "kosong" then 1 end)as kursi_kosong'))
            ->where('jadwals.status', 'belum')
            ->groupBy('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus', 'pivot_bus_rutes.harga')
            ->get();

        $belum = DB::table('transaksis')
            ->join('users', 'transaksis.id_customer', '=', 'users.id')
            ->join('jadwals', 'transaksis.id_jadwal', '=', 'jadwals.id')
            ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
            ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
            ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
            ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
            ->select('transaksis.id', 'transaksis.order_code', 'transaksis.barcode', 'users.name', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'pivot_bus_rutes.harga', 'transaksis.no_kursi', 'transaksis.status_bayar')
            ->where('transaksis.status_bayar', 'proses_admin')
            ->get();

        $sudah = DB::table('transaksis')
            ->join('users', 'transaksis.id_customer', '=', 'users.id')
            ->join('jadwals', 'transaksis.id_jadwal', '=', 'jadwals.id')
            ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
            ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
            ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
            ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
            ->select('transaksis.id', 'transaksis.order_code', 'transaksis.barcode', 'users.name', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'pivot_bus_rutes.harga', 'transaksis.no_kursi', 'transaksis.status_bayar')
            ->where('transaksis.status_bayar', 'sudah')
            ->get();
            // return $sudah;
    	
        return view('admin.transaksi', ['data' => $data]);
    }

    public function store()
    {
        $store_user = new \App\User();
        $store_user->name = $request->name;
        $store_user->save();

        $data = new \App\Transaksi();
        $data->id_jadwal = $request->id_jadwal;
        $data->id_customer = $store_user->id;
        $data->status_bayar= 'sudah';
        $data->no_kursi =$request->no_kursi;
        $data->trip = 'n';
        
        //qrcode
            $i = $request->id_jadwal;
            $order_code = \Carbon\Carbon::now().'id'.$i;
            $image = \QrCode::format('png')
                         ->size(200)->errorCorrection('H')
                         ->generate($order_code);
                         return $image;
        $output_file = 'public/img/qr-code/img-' . time() .  'asdar.png';
        Storage::disk('local')->put($output_file, $image);
        //end qrcode

        $data->order_code = $order_code;
        $data->save();

        //ubah status di tabel kursis
        $set_kursis = \App\Kursi::where('id_jadwal', $request->id_jadwal)->where('kursi', $request->no_kursi)
                        ->update([
                            'status' => 'terisi',
                        ]);
        //end ubah status di tabel kursis

        return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Menambah Data');
    }

    public function cekKursi($id)
    {
        $data = \App\Kursi::where('id_jadwal', $id)->get();
        return $data;
    }

    public function riwayat() //menampilkan riwayat transaksi
    {
        $data = DB::table('transaksis')
            ->join('users', 'transaksis.id_customer', '=', 'users.id')
            ->join('jadwals', 'transaksis.id_jadwal', '=', 'jadwals.id')
            ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
            ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
            ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
            ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
            ->select('transaksis.id', 'transaksis.order_code', 'transaksis.barcode', 'users.name', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'pivot_bus_rutes.harga', 'transaksis.no_kursi')
            ->where('transaksis.status_bayar', 'sudah')
            ->get();
        return $data;
            
        return view('admin.riwayattransaksi', ['data' => $data]);
    }
}
