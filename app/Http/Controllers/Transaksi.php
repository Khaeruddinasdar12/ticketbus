<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Metzli\Encoder\Encoder;
use Metzli\Renderer\PngRenderer;
use Storage;
class Transaksi extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() // halaman data-transaksi
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
            ->select('transaksis.id', 'transaksis.order_code', 'transaksis.bukti_transfer', 'users.id as id_user', 'users.name', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'pivot_bus_rutes.harga', 'transaksis.no_kursi', 'transaksis.status_bayar')
            ->where('transaksis.status_bayar', 'proses_admin')
            ->where('jadwals.status', 'belum')
            ->get();
        // return $sudah;

        return view('admin.transaksi', ['data' => $data, 'belum' => $belum]);
    }

    public function store(Request $request) // menginput transaksi customer
    {
        $store_user = new \App\User();
        $store_user->name = $request->name;
        $store_user->jkel = $request->jkel;
        $store_user->role = 'nologin';
        $store_user->save();

        $data = new \App\Transaksi();
        $data->id_jadwal = $request->id_jadwal;
        $data->id_customer = $store_user->id;
        $data->status_bayar = 'sudah';
        $data->no_kursi = $request->no_kursi;
        $data->trip = 'n';
        $data->admin = \Auth::user()->id;

            //qrcode
                $i = $request->id_jadwal;
                $order_code = \Carbon\Carbon::now() . 'jadwal' . $i;
                $code = Encoder::encode($order_code);
                $renderer = new PngRenderer();
                $image = $renderer->render($code);
                $path = 'img/qr-code/img-' . time() .  'bus.png';
                $output_file = 'public/'.$path;
                Storage::disk('local')->put($output_file, $image);
            //end qrcode

        $data->barcode = $path;
        $data->order_code = $order_code;
        $data->save();

        //ubah status di tabel kursis
        $set_kursis = \App\Kursi::where('id_jadwal', $request->id_jadwal)->where('kursi', $request->no_kursi)
            ->update([
                'status' => 'terisi',
            ]);
        //end ubah status di tabel kursis

        return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Menambah Data', 'id' => $data->id);
    }

    public function cekKursi($id) // cek kursi per jadwal
    {
        $data = \App\Kursi::where('id_jadwal', $id)->get();
        return $data;
    }

    public function riwayat() //menampilkan riwayat transaksi
    {
        $sudah = DB::table('transaksis')
            ->join('users as createdby', 'transaksis.id_customer', '=', 'createdby.id')
            ->leftJoin('users as canceledby', 'transaksis.admin', '=', 'canceledby.id')
            ->join('jadwals', 'transaksis.id_jadwal', '=', 'jadwals.id')
            ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
            ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
            ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
            ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
            ->select('transaksis.id', 'transaksis.order_code', 'transaksis.barcode', 'createdby.name', 'canceledby.name as canceledby', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'pivot_bus_rutes.harga', 'transaksis.no_kursi', 'transaksis.status_bayar')
            ->where('transaksis.status_bayar', 'sudah')
            ->orWhere('transaksis.status_bayar', 'canceled')
            ->get();
        // return $sudah;
        return view('admin.riwayattransaksi', ['sudah' => $sudah]);
    }

    public function editStatus($status, $id) //mengedit status belum bayar menjadi sudah atau cancel dari transaksi android
    {
        $data = \App\Transaksi::findOrFail($id);
        if($status == 'verified') {
            $data->status_bayar = 'sudah';
            $data->admin = \Auth::user()->id;
            //qrcode
                    // $code = $data->order_code;
                    $code = Encoder::encode($data->order_code);
                    $renderer = new PngRenderer();
                    $image = $renderer->render($code);
                    $path = 'img/qr-code/img-' . time() .  'bus.png';
                    $output_file = 'public/'.$path;
                    Storage::disk('local')->put($output_file, $image);
                //end qrcode
            $data->barcode = $path;
            $data->save();

            $kursi = \App\Kursi::where('id_jadwal', $data->id_jadwal)
                    ->where('kursi', $data->no_kursi)
                    ->update([
                        'status' => 'terisi',
                    ]);

            return $arrayName = array('status' => 'success', 'pesan' => 'Verifikasi Data Berhasil');
        } else if ($status == 'cancel') {
            // return $arrayName = array('status' => 'success', 'pesan' => 'Data Transaksi Dibatalkan');
            $data->status_bayar = 'canceled';
            $data->admin = \Auth::user()->id;
            $data->save();

            $kursi = \App\Kursi::where('id_jadwal', $data->id_jadwal)
                    ->where('kursi', $data->no_kursi)
                    ->update([
                        'status' => 'kosong',
                    ]);

            return $arrayName = array('status' => 'success', 'pesan' => 'Data Transaksi Dibatalkan');
        } else {
            abort(404);
        }
        
    }
}
