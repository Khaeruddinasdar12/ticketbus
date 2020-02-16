<?php

use Illuminate\Database\Seeder;

class KursiSeed extends Seeder
{
    public function run()
    {
        $count  = DB::table('jadwals')->select('id')->get();

        foreach ($count as $counts) {
            $data = DB::table('jadwals')
                    ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
                    ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
                    ->select('jadwals.id', 'bus.jumlah_kursi')
                    ->where('jadwals.id', $counts->id)
                    ->first();
            for ($i = 1; $i <= $data->jumlah_kursi; $i++) {
                DB::table('kursis')->insert([
                    'id_jadwal' => $data->id,
                    'kursi' => '' . $i,
                    'status' => 'kosong'
                ]);
            }
        }
    }
}
