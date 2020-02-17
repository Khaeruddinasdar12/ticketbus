<?php

use Illuminate\Database\Seeder;

class JadwalSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jadwals')->insert([
	        'id_bus_rute'  => 1,
	        'tanggal' => '2020-02-15',
	        'jam' => '20:00',
	        'status' => 'belum',
	        'created_by' => 1
		]);

		DB::table('jadwals')->insert([
	        'id_bus_rute'  => 1,
	        'tanggal' => '2020-02-18',
	        'jam' => '20:00',
	        'status' => 'belum',
	        'created_by' => 1
		]);
    }
}
