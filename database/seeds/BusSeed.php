<?php

use Illuminate\Database\Seeder;

class BusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bus')->insert([
	        'nama'  => 'Bintang Prima 1',
	        'id_tipebus' => 2,
	        'deskripsi' => 'dilengkapi dengan speaker dan selimut hangat',
	        'jumlah_kursi' => 32

		]);

		DB::table('bus')->insert([
	        'nama'  => 'Bintang Prima 2',
	        'id_tipebus' => 2,
	        'deskripsi' => 'dilengkapi dengan speaker dan selimut hangat',
	        'jumlah_kursi' => 32
	        
		]);

		DB::table('bus')->insert([
	        'nama'  => 'Bintang Prima 3',
	        'id_tipebus' => 1,
	        'deskripsi' => 'dilengkapi dengan speaker dan selimut hangat',
	        'jumlah_kursi' => 32
	        
		]);

		DB::table('bus')->insert([
	        'nama'  => 'Bintang Prima 4',
	        'id_tipebus' => 3,
	        'deskripsi' => 'dilengkapi dengan speaker dan selimut hangat',
	        'jumlah_kursi' => 32
	        
		]);

		DB::table('bus')->insert([
	        'nama'  => 'Bintang Prima 5',
	        'id_tipebus' => 1,
	        'deskripsi' => 'dilengkapi dengan speaker dan selimut hangat',
	        'jumlah_kursi' => 32
	        
		]);

    }
}
