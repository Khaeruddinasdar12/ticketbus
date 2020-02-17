<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class TransaksiSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //transaksi 1 
        DB::table('transaksis')->insert([
	        'id_jadwal'  => 1,
	        'id_customer' => 6,
	        'no_kursi' => '1',
	        'status_bayar' => 'proses_admin',
	        'order_code' => Carbon::now().'id1'
		]);
			DB::table('kursis')
				->where('id_jadwal', 1)
				->where('kursi', '1')
				->update(['status' => 'keranjang']);

		//transaksi 2		
		DB::table('transaksis')->insert([
	        'id_jadwal'  => 1,
	        'id_customer' => 6,
	        'no_kursi' => '2',
	        'status_bayar' => 'proses_admin',
	        'order_code' => Carbon::now().'id2'
		]);
			DB::table('kursis')
				->where('id_jadwal', 1)
				->where('kursi', '2')
				->update(['status' => 'keranjang']);

		//transaksi 3
		DB::table('transaksis')->insert([
	        'id_jadwal'  => 1,
	        'id_customer' => 6,
	        'no_kursi' => '3',
	        'status_bayar' => 'proses_admin',
	        'order_code' => Carbon::now().'id3'
		]);
			DB::table('kursis')
				->where('id_jadwal', 1)
				->where('kursi', '3')
				->update(['status' => 'keranjang']);
    }
}
