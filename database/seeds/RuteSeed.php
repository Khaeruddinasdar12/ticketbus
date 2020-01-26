<?php

use Illuminate\Database\Seeder;

class RuteSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rutes')->insert([	//rute 1
	        'rute'  => 'Makassar-Palopo'
		]);

		DB::table('rutes')->insert([	//rute 2
	        'rute'  => 'Makassar-Masamba'
		]);

		DB::table('rutes')->insert([	//rute 3
	        'rute'  => 'Makassar-Toraja'
		]);

		DB::table('rutes')->insert([	//rute 4
	        'rute'  => 'Palopo-Makassar'
		]);

		DB::table('rutes')->insert([	//rute 5
	        'rute'  => 'Masamba-Makassar'
		]);

		DB::table('rutes')->insert([	//rute 6
	        'rute'  => 'Toraja-Makassar'
		]);
    }
}
