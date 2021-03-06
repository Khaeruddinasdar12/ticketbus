<?php

Auth::routes();
// use DB;
// INVOICE
Route::get('invoice/{id}', 'Invoice@invoice');

// print invoice
Route::get('invoice-print/{id}', 'Invoice@print')->name('print');

Route::get('/', 'Dashboard@index')->name('index');
Route::get('dashboard', 'Dashboard@index')->name('index');


// RUTE CUSTOMER
Route::get('data-customer', 'Customer@index')->name('index.customer');

// RUTE TRANSAKSI
Route::get('data-transaksi', 'Transaksi@index')->name('index.transaksi');
Route::post('store-transaksi', 'Transaksi@store')->name('store.transaksi'); // menginput transaksi
Route::put('verifikasi-bayar/{status}/{id}', 'Transaksi@editStatus'); //mengubah status_bayar menjadi sudah
Route::get('cek-kursi/{id}', 'Transaksi@cekKursi');
Route::get('riwayat-transaksi', 'Transaksi@riwayat')->name('riwayat.transaksi');

// all JQUERY
Route::get('nama-bus/{id}', 'ApiJquery@namaBus');
Route::get('data-bus/{id}', 'ApiJquery@dataBus');

// RUTE MANAGEMEN BUS
Route::prefix('managemen-bus')->group(function () {
	Route::get('/', 'ManagemenBus@index')->name('index.bus'); //menampilkan halaman data bus
	Route::get('jalur-bus', 'ManagemenBus@pivot')->name('pivot.bus'); //menampilkan halaman jalur bus
	Route::get('tambah-bus', 'ManagemenBus@create')->name('tambah.bus'); //menampilkan halaman tambah bus

	Route::get('show-bus/{id}', 'ManagemenBus@showBus'); //jquery show bus di jalur

	Route::post('store-pivot', 'ManagemenBus@storePivotBusRute')->name('store.pivot');
	Route::post('store-bus', 'ManagemenBus@storeBus')->name('store.bus'); // menginput data bus
	Route::post('store-tipe-bus', 'ManagemenBus@storeTipeBus')->name('store.tipebus');
	Route::post('store-rute', 'ManagemenBus@storeRute')->name('store.rute');

	Route::put('edit-bus/{id}', 'ManagemenBus@editBus');
	Route::put('edit-tipe-bus/{id}', 'ManagemenBus@editTipe');
	Route::put('edit-rute/{id}', 'ManagemenBus@editRute');

	Route::delete('delete-bus/{id}', 'ManagemenBus@deleteBus');
	Route::delete('delete-tipe-bus/{id}', 'ManagemenBus@deleteTipe');
	Route::delete('delete-rute/{id}', 'ManagemenBus@deleteRute');
	Route::delete('delete-pivot/{id}', 'ManagemenBus@deletePivot');
});

// RUTE MANAGEMEN JADWAL
Route::prefix('managemen-jadwal')->group(function () {
	Route::get('/', 'Jadwal@index')->name('index.jadwal'); //menampilkan halaman data jadwal
	Route::get('tambah-jadwal', 'Jadwal@create')->name('create.jadwal'); //menampilkan halaman tambah jadwal
	Route::get('dalam-perjalanan', 'Jadwal@perjalanan')->name('perjalanan.jadwal'); //menampilkan halaman dalam perjalanan
	Route::get('riwayat-perjalanan', 'Jadwal@riwayat')->name('riwayat.jadwal'); //menampilkan halaman riwayat perjalanan

	//keperluan get jquery
	Route::get('filterby/{tipe}', 'Jadwal@tipe');
	Route::get('show-rute-perjalanan/{tipe}/{id}', 'Jadwal@showRutePerjalanan'); //menampilkan dropdown rute di input jadwal
	Route::get('deskripsi-bus/{id}', 'Jadwal@showDeskripsi'); //deskripsi bus dan harga perkursi
	//End keperluan get jquery

	Route::post('store-jadwal', 'Jadwal@store')->name('store.jadwal'); // input data jadwal

	Route::put('edit-status/{status}/{id}', 'Jadwal@editStatus'); //mengedit status jadwal menjadi perjalanan atau selesai
	Route::put('edit-jadwal/{id}', 'Jadwal@editJadwal'); //mengedit data jadwal

	Route::delete('delete-jadwal/{id}', 'Jadwal@destroy'); //menghapus data jadwal
});

// RUTE MANAGEMEN ADMIN
Route::prefix('managemen-admin')->group(function () {
	Route::get('/', 'ManagemenAdmin@index')->name('index.admin');
	Route::post('/', 'ManagemenAdmin@store')->name('store.admin'); // input data admin
});

// RUTE LAPORAN
Route::prefix('laporan')->group(function () {
	Route::get('/', 'Laporan@index')->name('index.laporan');
	Route::get('download', 'Laporan@download')->name('download.laporan');
	Route::get('test', 'Laporan@test');
});