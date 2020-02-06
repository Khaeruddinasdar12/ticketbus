<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('home');
});

Auth::routes();

Route::get('dashboard', 'Dashboard@index')->name('index');


Route::get('data-transaksi', 'Transaksi@index')->name('index.transaksi');
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
	Route::get('tambah-jadwal', 'Jadwal@create')->name('create.jadwal');//menampilkan halaman tambah jadwal
	Route::get('riwayat-perjalanan', 'Jadwal@riwayat')->name('riwayat.jadwal');//menampilkan halaman riwayat perjalana

	//keperluan get jquery
	Route::get('filterby/{tipe}', 'Jadwal@tipe');
	Route::get('show-rute-perjalanan/{tipe}/{id}', 'Jadwal@showRutePerjalanan'); //menampilkan dropdown rute di input jadwal
	Route::get('deskripsi-bus/{id}', 'Jadwal@showDeskripsi'); //deskripsi bus dan harga perkursi
	//End keperluan get jquery

	Route::post('store-jadwal', 'Jadwal@store')->name('store.jadwal'); // input data jadwal

	Route::delete('delete-bus/{id}', 'ManagemenBus@deleteBus');
});

// RUTE MANAGEMEN ADMIN
Route::prefix('managemen-admin')->group(function () {
	Route::get('/', 'ManagemenAdmin@index')->name('index.admin');
	Route::post('/', 'ManagemenAdmin@store')->name('store.admin'); // input data admin
});
