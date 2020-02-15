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

Route::post('transaksi', 'api\Transaksi@store'); // input transaksi

Route::get('jadwals', 'api\Jadwal@jadwals'); //menampilkan semua jadwal yang belum berangkat /tersedia