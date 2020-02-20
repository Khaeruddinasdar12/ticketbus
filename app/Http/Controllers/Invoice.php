<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Invoice extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function invoice($id)
	{
		\App\Transaksi::findOrFail($id);
		$data = DB::table('transaksis')
			->join('users', 'transaksis.id_customer', '=', 'users.id')
			->join('jadwals', 'transaksis.id_jadwal', '=', 'jadwals.id')
			->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
			->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
			->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
			->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
			->select('transaksis.id', 'transaksis.order_code', 'transaksis.barcode', 'users.name', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'pivot_bus_rutes.harga', 'transaksis.no_kursi', 'transaksis.status_bayar')
			->where('transaksis.status_bayar', 'sudah')
			->where('transaksis.id', $id)
			->get();
		// return $data;
		return view('admin.invoice', ['data' => $data]);
	}

	public function print($id)
	{
		\App\Transaksi::findOrFail($id);
		$data = DB::table('transaksis')
			->join('users', 'transaksis.id_customer', '=', 'users.id')
			->join('jadwals', 'transaksis.id_jadwal', '=', 'jadwals.id')
			->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
			->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
			->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
			->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
			->select('transaksis.id', 'transaksis.order_code', 'transaksis.barcode', 'users.name', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'pivot_bus_rutes.harga', 'transaksis.no_kursi', 'transaksis.status_bayar')
			->where('transaksis.status_bayar', 'sudah')
			->where('transaksis.id', $id)
			->get();
		// return $data;
		return view('admin.invoice-print', ['data' => $data]);
	}
}
