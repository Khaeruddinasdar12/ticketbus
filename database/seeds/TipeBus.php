<?php

use Illuminate\Database\Seeder;

class TipeBus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipebus')->insert([
	        'nama'  => 'Sleeper'
		]);

		DB::table('tipebus')->insert([
	        'nama'  => 'Suspensi'
		]);

		DB::table('tipebus')->insert([
	        'nama'  => 'Scania'
		]);
    }
}
