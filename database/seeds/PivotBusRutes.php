<?php

use Illuminate\Database\Seeder;

class PivotBusRutes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pivot_bus_rutes')->insert([	//rute 1
	        'id_rute'  => 1,
	        'id_bus'	=> 1,
	        'harga' 	=>	250000,
		]);

		DB::table('pivot_bus_rutes')->insert([	//rute 1
	        'id_rute'  => 1,
	        'id_bus'	=> 2,
	        'harga' 	=>	280000,	
		]);

		DB::table('pivot_bus_rutes')->insert([	//rute 1
	        'id_rute'  => 1,
	        'id_bus'	=> 3,
	        'harga' 	=>	200000,	
		]);

		DB::table('pivot_bus_rutes')->insert([	//rute 1
	        'id_rute'  => 1,
	        'id_bus'	=> 4,
	        'harga' 	=>	180000,	
		]);

		DB::table('pivot_bus_rutes')->insert([	//rute 1
	        'id_rute'  => 1,
	        'id_bus'	=> 5,
	        'harga' 	=>	220000,	
		]);

		DB::table('pivot_bus_rutes')->insert([	//rute 1
	        'id_rute'  => 2,
	        'id_bus'	=> 1,
	        'harga' 	=>	260000,	
		]);

		DB::table('pivot_bus_rutes')->insert([	//rute 1
	        'id_rute'  => 2,
	        'id_bus'	=> 2,
	        'harga' 	=>	180000,	
		]);

		DB::table('pivot_bus_rutes')->insert([	//rute 1
	        'id_rute'  => 2,
	        'id_bus'	=> 3,
	        'harga' 	=>	150000,	
		]);

		DB::table('pivot_bus_rutes')->insert([	//rute 1
	        'id_rute'  => 2,
	        'id_bus'	=> 4,
	        'harga' 	=>	200000,	
		]);

		DB::table('pivot_bus_rutes')->insert([	//rute 1
	        'id_rute'  => 2,
	        'id_bus'	=> 5,
	        'harga' 	=>	250000,	
		]);


    }
}
