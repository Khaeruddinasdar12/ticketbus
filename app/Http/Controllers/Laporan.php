<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
class Laporan extends Controller
{
    public function __construct()
	{
	 
	    $this->middleware('auth');
	}

	public function test()
	{

		$month = 4;
		$year = 2020;
		$data = DB::table('jadwals')
		      ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
		      ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
		      ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
		      ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
		      ->rightJoin('kursis', 'jadwals.id', 'kursis.id_jadwal')
		      ->select('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'pivot_bus_rutes.harga', DB::raw('count(case when kursis.status = "terisi" then 1 end)as kursi_terisi'), 'jadwals.arrived_at',
		      		DB::raw('count(case when kursis.status = "terisi" then 1 end) * pivot_bus_rutes.harga as sub_total')
		       )
		      ->where('jadwals.status', 'selesai')
		      ->whereMonth('jadwals.tanggal', $month)
		      ->whereYear('jadwals.tanggal', $year)
		      ->groupBy('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus', 'pivot_bus_rutes.harga', 'arrived_at')
		      ->get();

		      if($data == '[]') {
		      	$total = 0;
		      } else {
			      foreach ($data as $datas) {
			      	$total[] = $datas->sub_total ;
			      }
			      $total = array_sum($total);
			  }

			  // return view('admin.pdf', ['data' => $data, 'judul' => 'LAPORAN FEBRUARI'.' '.$year , 'total' => $total ]);
		$pdf = PDF::loadView('admin.pdf', 
			[
				'data' => $data, 
				'judul' => 'LAPORAN '.$month .' '.$year , 
				'total' => $total 
			]);
		// return $pdf->stream();
      	return $pdf->download('laporan-'.$month.'-'.$year.'.pdf');
	}

	public function download(Request $request)
	{

		$bulan = $request->get('month');
		$year = $request->get('year');
		
		switch ($bulan) {
			case 1:
				$month = 'JANUARRI';
				break;
			case 2:
				$month = 'FEBRUARI';
				break;
			case 3:
				$month = 'MARET';
				break;
			case 4:
				$month = 'APRIL';
				break;
			case 5:
				$month = 'MEI';
				break;
			case 6:
				$month = 'JUNI';
				break;
			case 7:
				$month = 'JULI';
				break;
			case 8:
				$month = 'AGUSTUS';
				break;
			case 9:
				$month = 'SEPTEMBER';
				break;
			case 10:
				$month = 'OKTEOBER';
				break;
			case 11:
				$month = 'NOVEMBER';
				break;
			case 12:
				$month = 'DESEMBER';
				break;
			
			default:
				$month = '';
				break;
		}

		if(empty($bulan) && empty($year)) {
			$data = DB::table('jadwals')
		      ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
		      ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
		      ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
		      ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
		      ->rightJoin('kursis', 'jadwals.id', 'kursis.id_jadwal')
		      ->select('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'pivot_bus_rutes.harga', DB::raw('count(case when kursis.status = "terisi" then 1 end)as kursi_terisi'), 'jadwals.arrived_at',
		      		DB::raw('count(case when kursis.status = "terisi" then 1 end) * pivot_bus_rutes.harga as sub_total')
		       )
		      ->where('jadwals.status', 'selesai')
		      ->groupBy('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus', 'pivot_bus_rutes.harga', 'arrived_at')
		      ->get();
		      $keterangan = 'Laporan Keseluruhan';
		} else if (empty($bulan)) {
			$data = DB::table('jadwals')
		      ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
		      ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
		      ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
		      ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
		      ->rightJoin('kursis', 'jadwals.id', 'kursis.id_jadwal')
		      ->select('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'pivot_bus_rutes.harga', DB::raw('count(case when kursis.status = "terisi" then 1 end)as kursi_terisi'), 'jadwals.arrived_at',
		      		DB::raw('count(case when kursis.status = "terisi" then 1 end) * pivot_bus_rutes.harga as sub_total')
		       )
		      ->where('jadwals.status', 'selesai')
		      ->whereYear('jadwals.tanggal', $year)
		      ->groupBy('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus', 'pivot_bus_rutes.harga', 'arrived_at')
		      ->get();
		      $keterangan = $year;
		} else {
			$data = DB::table('jadwals')
		      ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
		      ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
		      ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
		      ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
		      ->rightJoin('kursis', 'jadwals.id', 'kursis.id_jadwal')
		      ->select('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'pivot_bus_rutes.harga', DB::raw('count(case when kursis.status = "terisi" then 1 end)as kursi_terisi'), 'jadwals.arrived_at',
		      		DB::raw('count(case when kursis.status = "terisi" then 1 end) * pivot_bus_rutes.harga as sub_total')
		       )
		      ->where('jadwals.status', 'selesai')
		      ->whereMonth('jadwals.tanggal', $bulan)
		      ->whereYear('jadwals.tanggal', $year)
		      ->groupBy('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus', 'pivot_bus_rutes.harga', 'arrived_at')
		      ->get();
		      $keterangan = $month .' '. $year ;
		}
		
	      
		      if($data == '[]') {
		      	$total = 0;
		      } else {
			      foreach ($data as $datas) {
			      	$total[] = $datas->sub_total ;
			      }
			      $total = array_sum($total);
			  }

		$pdf = PDF::loadView('admin.pdf', 
			[
				'data' => $data, 
				'judul' => 'LAPORAN '.$keterangan , 
				'total' => $total 
			]);

      	return $pdf->download('laporan-'.$month.'-'.$year.'.pdf');
		
	}

	public function index(Request $request)
	{
		$bulan = $request->get('month');
		$year = $request->get('year');

		$tahun = DB::table('jadwals')->selectRaw('YEAR(tanggal) as date')->distinct()->get();
		
		switch ($bulan) {
			case 1:
				$month = 'Januari';
				break;
			case 2:
				$month = 'Februari';
				break;
			case 3:
				$month = 'Maret';
				break;
			case 4:
				$month = 'April';
				break;
			case 5:
				$month = 'Mei';
				break;
			case 6:
				$month = 'Juni';
				break;
			case 7:
				$month = 'Juli';
				break;
			case 8:
				$month = 'Agustus';
				break;
			case 9:
				$month = 'September';
				break;
			case 10:
				$month = 'Oktober';
				break;
			case 11:
				$month = 'November';
				break;
			case 12:
				$month = 'Desember';
				break;
			
			default:
				$month = '';
				break;
		}

		if(empty($bulan) && empty($year)) {
			$data = DB::table('jadwals')
		      ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
		      ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
		      ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
		      ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
		      ->rightJoin('kursis', 'jadwals.id', 'kursis.id_jadwal')
		      ->select('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'pivot_bus_rutes.harga', DB::raw('count(case when kursis.status = "terisi" then 1 end)as kursi_terisi'), 'jadwals.arrived_at',
		      		DB::raw('count(case when kursis.status = "terisi" then 1 end) * pivot_bus_rutes.harga as sub_total')
		       )
		      ->where('jadwals.status', 'selesai')
		      ->groupBy('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus', 'pivot_bus_rutes.harga', 'arrived_at')
		      ->get();
		      $keterangan = 'Laporan Keseluruhan';
		} else if (empty($bulan)) {
			$data = DB::table('jadwals')
		      ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
		      ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
		      ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
		      ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
		      ->rightJoin('kursis', 'jadwals.id', 'kursis.id_jadwal')
		      ->select('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'pivot_bus_rutes.harga', DB::raw('count(case when kursis.status = "terisi" then 1 end)as kursi_terisi'), 'jadwals.arrived_at',
		      		DB::raw('count(case when kursis.status = "terisi" then 1 end) * pivot_bus_rutes.harga as sub_total')
		       )
		      ->where('jadwals.status', 'selesai')
		      ->whereYear('jadwals.tanggal', $year)
		      ->groupBy('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus', 'pivot_bus_rutes.harga', 'arrived_at')
		      ->get();
		      $keterangan = $year;
		} else {
			$data = DB::table('jadwals')
		      ->join('pivot_bus_rutes', 'jadwals.id_bus_rute', '=', 'pivot_bus_rutes.id')
		      ->join('rutes', 'pivot_bus_rutes.id_rute', '=', 'rutes.id')
		      ->join('bus', 'pivot_bus_rutes.id_bus', '=', 'bus.id')
		      ->join('tipebus', 'bus.id_tipebus', '=', 'tipebus.id')
		      ->rightJoin('kursis', 'jadwals.id', 'kursis.id_jadwal')
		      ->select('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'bus.nama as namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus.nama as tipebus', 'pivot_bus_rutes.harga', DB::raw('count(case when kursis.status = "terisi" then 1 end)as kursi_terisi'), 'jadwals.arrived_at',
		      		DB::raw('count(case when kursis.status = "terisi" then 1 end) * pivot_bus_rutes.harga as sub_total')
		       )
		      ->where('jadwals.status', 'selesai')
		      ->whereMonth('jadwals.tanggal', $bulan)
		      ->whereYear('jadwals.tanggal', $year)
		      ->groupBy('jadwals.id', 'jadwals.tanggal', 'jadwals.jam', 'namabus', 'bus.deskripsi', 'rutes.rute', 'tipebus', 'pivot_bus_rutes.harga', 'arrived_at')
		      ->get();
		      $keterangan = $month .' '. $year ;
		}
		
	      
		      if($data == '[]') {
		      	$total = 0;
		      } else {
			      foreach ($data as $datas) {
			      	$total[] = $datas->sub_total ;
			      }
			      $total = array_sum($total);
			  }

		return view('admin.laporan', 
			['tahun' => $tahun, 
			'data' => $data, 
			'total' => $total, 
			'year' => $year,
			'bulan' => $bulan,
			'month' => $month,
			'keterangan' => $keterangan
		]);
	}

}
