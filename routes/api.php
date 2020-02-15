<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'api\User@login'); // login
Route::post('register', 'api\User@register'); //register


// ---------------- ALUR TRANSAKSI ----------------

	// FITUR  PESAN TIKET
	// no.1
	Route::get('jadwals', 'api\Jadwal@jadwals'); //menampilkan semua jadwal yang belum berangkat /tersedia
	// no.2
	Route::get('cek-kursi/{id}', 'api\Transaksi@cekKursi'); // cek kursi berdasarkan id jadwal dan pilih kursi
	// no.3
	Route::post('transaksi', 'api\Transaksi@store'); // input transaksi 


	// FITUR PEMBAYARAN
	// no.4
	Route::get('transaksi/{id}', 'api\Transaksi@list_belum_bayar'); //menampilkan daftar transaksi yang belum di bayar
	// no.5
	Route::post('bukti-store/{id}', 'api\Transaksi@buktiStore'); // menginput bukti transfer berdasarkan id transaksi


	// FITUR E-TICKET
	// no.6
	Route::get('e-tiket', 'api\Transaksi@tiket'); // menampilkan e-ticket

// ---------------- AKHIR ALUR TRANSAKSI ----------------


// FIUTR CEK PEMBAYARAN
Route::get('cek-pembayaran', 'api\Transaksi@cek_transaksi'); // mengecek status transaksi


//FITUR RIWAYAT TRANSAKSI
Route::get('riwayat/{id}', 'api\Transaksi@riwayat');// menampilkan riwayat transaksi user