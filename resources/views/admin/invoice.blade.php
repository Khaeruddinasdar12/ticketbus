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

          <div class="row invoice-info">
            <div class="col-12">
              @foreach($data as $datas)
              <img src="{{asset('storage/'.$data->barcode)}}" alt="">
              @endforeach
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Qty</th>
                    <th>Product</th>
                    <th>Serial #</th>
                    <th>Description</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Call of Duty</td>
                    <td>455-981-221</td>
                    <td>El snort testosterone trophy driving gloves handsome</td>
                    <td>$64.50</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Need for Speed IV</td>
                    <td>247-925-726</td>
                    <td>Wes Anderson umami biodiesel</td>
                    <td>$50.00</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Monsters DVD</td>
                    <td>735-845-642</td>
                    <td>Terry Richardson helvetica tousled street art master</td>
                    <td>$10.70</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Grown Ups Blue Ray</td>
                    <td>422-568-642</td>
                    <td>Tousled lomo letterpress</td>
                    <td>$25.99</td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection