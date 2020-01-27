<?php

use Illuminate\Database\Seeder;

class KursiSeed extends Seeder
{
    public function run()
    {
        $count  = DB::table('bus')->select('id')->get();
        foreach ($count as $counts) {
            $data = DB::table('bus')->select('id', 'jumlah_kursi')->where('id', $counts->id)->first();
            for ($i = 1; $i <= $data->jumlah_kursi; $i++) {
                DB::table('kursis')->insert([
                    'id_bus' => $data->id,
                    'kursi' => '' . $i,
                    'status' => 'kosong'
                ]);
            }
        }
    }
}
