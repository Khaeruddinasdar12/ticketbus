<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
	        'name'  => 'Khaeruddin Asdar',
	        'email' => 'khaeruddinasdar12@gmail.com',
	        'username' => 'asdar',
	        'role' => 'superadmin',
	        'alamat' => 'Jalan Paccerakkang',
	        'password'  => bcrypt('12345678')
		]);

		DB::table('users')->insert([
	        'name'  => 'Rijal Pardi',
	        'email' => 'rijal@gmail.com',
	        'username' => 'rijal',
	        'role' => 'kernet',
	        'alamat' => 'Jalan Paccerakkang',
	        'password'  => bcrypt('12345678')
		]);

		DB::table('users')->insert([
	        'name'  => 'Adhe Pratam',
	        'email' => 'adhe@gmail.com',
	        'username' => 'adhe',
	        'role' => 'kernet',
	        'alamat' => 'Jalan Paccerakkang',
	        'password'  => bcrypt('12345678')
		]);
    }
}
