<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class Transaksi extends Controller
{
    public function index()
    {
    	$data = DB::table('jadwals')
            ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
            ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
            ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
            ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
            ->rightJoin('kursis', 'jadwals.id', 'kursis.id_jadwal')
            ->select('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', DB::raw('count(case when kursis.status = "kosong" then 1 end)as kursi_kosong'))
            ->where('jadwals.status', 'belum')
            ->groupBy('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus')
            ->get();
            // return $data;
    	
        return view('admin.transaksi', ['data' => $data]);
    }

    public function store()
    {
        // $store_user = new \App\User();
        // $store_user->name = $request->name;
        // $store_user->save();

        // $data = new \App\Transaksi();
        // $data->id_jadwal = $request->id_jadwal;
        // $data->id_customer = $store_user->id;
        // $data->status_bayar= 'sudah';
        // $data->no_kursi =$request->no_kursi;
        
        //qrcode
            $i = 1000000;
            $order_code = \Carbon\Carbon::now().$i;
            // return $order_code;
            $image = \QrCode::
                         size(200)->errorCorrection('H')
                         ->generate($order_code);
                         return $image;
        $output_file = 'public/img/qr-code/img-' . time() .  'asdar.png';
        // Storage::disk('local')->put($output_file, $image);
        //end qrcode
    }

    public function cekKursi($id)
    {
        $data = \App\Kursi::where('id_jadwal', $id)->get();
        return $data;
    }

    public function riwayat()
    {
        // $data = DB::table('jadwals')
        //     ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
        //     ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
        //     ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
        //     ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
        //     ->rightJoin('kursis', 'jadwals.id', 'kursis.id_jadwal')
        //     ->select('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', DB::raw('count(case when kursis.status = "kosong" then 1 end)as kursi_kosong'))
        //     ->where('jadwals.status', 'belum')
        //     ->groupBy('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus')
        //     ->get();
            
        return view('admin.riwayattransaksi');
    }
}
