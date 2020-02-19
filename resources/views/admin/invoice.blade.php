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
          <h5> Halaman ini adalah e-Ticket nama, Klik tombol print di bawah sebagai tanda bukti </h5>
          <div class="row no-print mt-3">

            <div class="col-12">
              <a href="invoice-print.html" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Print</a>
            </div>

          </div>
        </div>


        <!-- Main content -->
        <div class="invoice p-3 mb-3">
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <i class="fas fa-bus-alt"></i> Bintang Prima.
                <small class="float-right">Date: 2/10/2014</small>
              </h4>
            </div>
          </div>
          <hr>

          <div class="row mt-5">
            <div class="col-md-2 offset-md-1">
              @foreach($data as $datas)
              <img src="{{asset('storage/'.$datas->barcode)}}" alt="Astec Code" style="width: 200px;">
            </div>

            <div class="col-md-8 table-responsive ml-4">
              <table class="table">
                <tr>
                  <th>Nama</th>
                  <td>:</td>
                  <td>{{ $datas->name }}</td>
                </tr>

                <tr>
                  <th>Email</th>
                  <td>:</td>
                </tr>

                <tr>
                  <th>Tanggal Berangkat</th>
                  <td>:</td>
                </tr>

                <tr>
                  <th>Nomor Kursi</th>
                  <td>:</td>
                </tr>

                <tr>
                  <th>Tipe Bus</th>
                  <td>:</td>
                </tr>

                <tr>
                  <th>Nomor Polisi / DD</th>
                  <td>:</td>
                </tr>

                <tr>
                  <th>Jam Berangkat</th>
                  <td>:</td>
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