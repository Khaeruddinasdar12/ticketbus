<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Transaksi extends Controller
{
    public function store() // bertransaksi di android
    {
        $data = new \App\Transaksi();
        $data->id_jadwal = $request->id_jadwal;
        $data->id_customer = $store_user->id;
        $data->status_bayar = 'sudah';
        $data->no_kursi = $request->no_kursi;
        $data->trip = 'n';

        //qrcode
        $i = $request->id_jadwal;
        $order_code = \Carbon\Carbon::now() . 'id' . $i;
        $code = Encoder::encode($order_code);
        $renderer = new PngRenderer();
        $image = $renderer->render($code);
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
}
