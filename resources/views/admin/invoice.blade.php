@extends('layouts.template')

@section('title')
Transaksi
@endsection

@section('content')
<style>
  .no-print .col-12 a {
    color: white;
    text-decoration: none;
  }
</style>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 mt-4">
        <div class="callout callout-info">
          @foreach($data as $datas)
          <h5> Halaman ini adalah e-Ticket {{ $datas->name }}, Klik tombol print di bawah, untuk mencetak file sebagai tanda bukti </h5>
          <div class="row no-print mt-3">

            <div class="col-12">
              <a href="{{ route('print',['id'=>$datas->id]) }}" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Print</a>
            </div>

          </div>
        </div>

        <!-- Main content -->
        <div class="invoice p-3 mb-3">
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <img src="{{ asset('bintangprima.png') }}" alt="Logo Bintang Prima" width="250px">
                <small class="float-right">Date: {{ $datas->tanggal }}</small>
              </h4>
            </div>
          </div>
          <hr>

          <div class="row mt-5">
            <div class="col-md-2 offset-md-1">
              <img src="{{asset('storage/'.$datas->barcode)}}" alt="Astec Code" style="width: 200px;">
              <hr>
              <h4>Order code :</h4>
              <p>{{ $datas->order_code }}</p>
            </div>

            <div class="col-md-8 table-responsive ml-4">
              <table class="table">
                <tr>
                  <th>Nama</th>
                  <th>:</th>
                  <th>{{ $datas->name }}</th>
                </tr>

                <tr>
                  <th>Tanggal Berangkat</th>
                  <th>:</th>
                  <th>{{ $datas->tanggal }}</th>
                </tr>

                <tr>
                  <th>Nomor Kursi</th>
                  <th>:</th>
                  <th>{{ $datas->no_kursi }}</th>
                </tr>

                <tr>
                  <th>Tipe Bus</th>
                  <th>:</th>
                  <th>{{ $datas->tipebus }}</th>
                </tr>

                <tr>
                  <th>Nomor Polisi / DD</th>
                  <th>:</th>
                  <th>{{ $datas->namabus }}</th>
                </tr>

                <tr>
                  <th>Jam Berangkat</th>
                  <th>:</th>
                  <th>{{ $datas->jam }}</th>
                </tr>

                <tr>
                  <th>Status Bayar</th>
                  <th>:</th>
                  <th>{{ $datas->status_bayar }}</th>
                </tr>
                @endforeach
              </table>
            </div>
          </div>
          <!-- /.row -->
        </div>
      </div>
    </div>
  </div>
</section>
@endsection