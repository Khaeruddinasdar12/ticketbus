<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Dashboard extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() 
    {
    	$transaksi 	= DB::table('transaksis')
    					->join('jadwals', 'transaksis.id_jadwal', '=', 'jadwals.id')
    					->where('jadwals.status', 'belum')
    					->where('transaksis.status_bayar', 'sudah')
    					->count();
    	
    	$jadwal 	= \App\Jadwal::where('status', 'belum')
    					->count();

    	$tipe = DB::table('tipebus')
    			->join('bus', 'tipebus.id', 'bus.id_tipebus')
    			->select('tipebus.nama', DB::raw('count(case when bus.id_tipebus = tipebus.id then 1 end)as jml'))
    			->groupBy('tipebus.nama')
    			->get();
    	// return $tipe;
        return view('admin.dashboard', ['tipe' => $tipe, 'transaksi' => $transaksi, 'jadwal' => $jadwal]);
    }
}
