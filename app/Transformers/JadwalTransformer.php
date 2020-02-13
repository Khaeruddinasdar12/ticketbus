<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use DB;
class JadwalTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        //
    ];
    protected $availableIncludes = [
        //
    ];

    public function transform()
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

        return [
            'id' => $data->id,
        ];
    }
}
