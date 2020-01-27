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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('dashboard', 'Dashboard@index')->name('index');
Route::get('managemen-bus', 'ManagemenBus@index')->name('index.bus');
Route::get('data-bus', 'ManagemenBus@data')->name('data.bus');
Route::get('managemen-jadwal', 'Jadwal@index')->name('index.jadwal');
Route::get('data-transaksi', 'Transaksi@index')->name('index.transaksi');
Route::get('riwayat-transaksi', 'Transaksi@riwayat')->name('riwayat.transaksi');
Route::get('managemen-admin', 'ManagemenAdmin@index')->name('index.admin');
Route::post('managemen-admin', 'ManagemenAdmin@store')->name('store.admin'); // input data admin
