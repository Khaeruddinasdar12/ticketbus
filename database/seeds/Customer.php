<?php

use Illuminate\Database\Seeder;

class Customer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
	        'nama'  => 'Rijal Pardi',
	        'email' => 'rijal@gmail.com',
	        'username' => 'rijal',
	        'password'  => bcrypt('12345678')
		]);

		DB::table('customers')->insert([
	        'nama'  => 'Lalassi',
	        'email' => 'lala@gmail.com',
	        'username' => 'lala',
	        'password'  => bcrypt('12345678')
		]);
    }
}
