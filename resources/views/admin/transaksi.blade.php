@extends('layouts.template')

@section('title')
Transaksi
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Transaksi</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Data Transaksi</a></li>
          <!-- <li class="breadcrumb-item active">Dashboard v1</li> -->
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Data Transaksi Customer</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nama Customer</th>
                <th>Email</th>
                <th>Tgl Berangkat</th>
                <th>Nama Bus</th>
                <th>Status</th>
                <th>Detail</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Baco</td>
                <td>baco@gmail.com</td>
                <td>1 januari 1990</td>
                <td>Bintang Prima</td>
                <td>Ragu - Ragu</td>
                <td> <button class="btn btn-primary" data-toggle="modal" data-target="#showdetail">show</button> </td>
              </tr>
            </tbody>
            <!-- Modal -->
            <div class="modal fade" id="showdetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detal Transaksi (Nama Customer)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-4" style="border-right: 1px solid #c7c9ca">
                          <h6>Order Code</h6>
                          <h5>123456 - example</h5>
                          <hr>
                          <h6>BarCode</h6>
                          <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" alt="">
                        </div>
                        <div class="col-md-7 offset-md-1" style="margin: auto">
                          <div class="row">

                            <div class="col-md-5">
                              <h6>Nama Customer</h6>
                              <h6>Email</h6>
                              <h6>Tanggal Berangkat</h6>
                              <h6>Jam Berangkat</h6>
                              <h6>Nama Bus</h6>
                              <h6>Harga</h6>
                              <h6>Type Bus</h6>
                              <h6>Status</h6>
                            </div>

                            <div class="col-md-1">
                              <h6>:</h6>
                              <h6>:</h6>
                              <h6>:</h6>
                              <h6>:</h6>
                              <h6>:</h6>
                              <h6>:</h6>
                              <h6>:</h6>
                              <h6>:</h6>
                            </div>

                            <div class="col-md-6">
                              <h6>Baco Baco Becce Becce</h6>
                              <h6>Baco@gmail.com</h6>
                              <h6>1 januari 1990</h6>
                              <h6>Pukul 00:00 WITA</h6>
                              <h6>Bintang Prima</h6>
                              <h6>Rp. 10.000</h6>
                              <h6>Full Stack Bus</h6>
                              <h6>Ragu - Ragu</h6>
                            </div>


                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</section>
@endsection

@section('js')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script>
  $(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
@endsection