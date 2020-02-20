<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TicketBus | invoice-print</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <script>
    window.print();
  </script>
</head>

<body>
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

          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fas fa-bus-alt"></i> Bintang Prima.
                  @foreach($data as $datas)
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
</body>

</html>