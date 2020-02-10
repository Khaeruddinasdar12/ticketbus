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
	        'email' => 'rijalpardi@gmail.com',
	        'username' => 'rijal',
	        'role' => 'superadmin',
	        'alamat' => 'Btp Blok M no. 541',
	        'password'  => bcrypt('12345678')
		]);

		DB::table('users')->insert([
	        'name'  => 'Risky Nurmala',
	        'email' => 'lala@gmail.com',
	        'username' => 'lala',
	        'role' => 'superadmin',
	        'alamat' => 'Jalan Pongtiku',
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
	        'name'  => 'Adhe Pratama',
	        'email' => 'adhe@gmail.com',
	        'username' => 'adhe',
	        'role' => 'kernet',
	        'alamat' => 'Jalan Paccerakkang',
	        'password'  => bcrypt('12345678')
		]);
    }
}
