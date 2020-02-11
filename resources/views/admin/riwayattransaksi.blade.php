@extends('layouts.template')

@section('title')
Data Jadwal
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
          <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
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
          <h3 class="card-title">Data Transaksi</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="tab-pane text-left fade show active" id="vert-tabs-add" role="tabpanel" aria-labelledby="vert-tabs-add-tab">
                <table id="example3" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Nama Customer</th>
                      <th>Nama Bus</th>
                      <th>Tgl Berangkat</th>
                      <th>Jam Berangkat</th>
                      <th>Status</th>
                      <th>Detail</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($sudah as $sudahbyr)
                    <tr>
                      <td>{{ $sudahbyr->name }}</td>
                      <td>{{ $sudahbyr->namabus }}</td>
                      <td>{{ $sudahbyr->tanggal }}</td>
                      <td>{{ $sudahbyr->jam }}</td>
                      <td>
                        <button class="btn btn-success" title="sudah bayar"><i class=" far fa-check-square"></i></button>
                      </td>

                      <td>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#showdetail2" title="lihat detail" data-id="{{ $sudahbyr->id }}" data-order="{{ $sudahbyr->order_code }}" data-barcode="{{ $sudahbyr->barcode }}" data-nama="{{ $sudahbyr->name }}" data-tgl="{{ $sudahbyr->tanggal }}" data-jam="{{ $sudahbyr->jam }}" data-bus="{{ $sudahbyr->namabus }}" data-desc="{{ $sudahbyr->deskripsi }}" data-rute="{{ $sudahbyr->rute }}" data-tipe="{{ $sudahbyr->tipebus }}" data-harga="{{ $sudahbyr->harga }}" data-kursi="{{ $sudahbyr->no_kursi }}" data-status="{{ $sudahbyr->status_bayar }}"><i class=" far fa-eye"></i></button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <!-- Modal -->
                  <div class="modal fade" id="showdetail2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <h5 id="orders"></h5>
                                <hr>
                                <h6>BarCode</h6>
                                <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" alt="">
                              </div>
                              <div class="col-md-7 offset-md-1" style="margin: auto">
                                <div class="row">

                                  <div class="col-md-5">
                                    <h6>Nama Customer</h6>
                                    <h6>Tanggal Berangkat</h6>
                                    <h6>Jam Berangkat</h6>
                                    <h6>Nama Bus</h6>
                                    <h6>Rute Bus</h6>
                                    <h6>Nomor Kursi</h6>
                                    <h6>Harga</h6>
                                    <h6>Tipe Bus</h6>
                                    <h6>Deskripsi</h6>
                                    <br>
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
                                    <h6>:</h6>
                                    <br>
                                    <h6>:</h6>
                                  </div>

                                  <div class="col-md-6">
                                    <h6 id="namas"></h6>
                                    <h6 id="tanggals"></h6>
                                    <h6 id="jams"></h6>
                                    <h6 id="namabuss"></h6>
                                    <h6 id="rutebuss"></h6>
                                    <h6 id="nokursis"></h6>
                                    <h6 id="hargas"></h6>
                                    <h6 id="tipebuss"></h6>
                                    <h6 id="deskripsis"></h6>
                                    <h6 id="statuss"></h6>
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
            </div>
          </div>
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
    $("#example3").DataTable();
  });
</script>
<script>
  // detail transaksi sudah bayar
  $('#showdetail2').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var order = button.data('order')
    var barcode = button.data('barcode')
    var nama = button.data('nama')
    var tgl = button.data('tgl')
    var jam = button.data('jam')
    var bus = button.data('bus')
    var desc = button.data('desc')
    var rute = button.data('rute')
    var tipe = button.data('tipe')
    var harga = button.data('harga')
    var kursi = button.data('kursi')
    var status = button.data('status')

    var modal = $(this)
    modal.find('.modal-title').text('Detail Transaksi ' + nama)
    modal.find('.modal-body #orders').text(order)
    modal.find('.modal-body #namas').text(nama)
    modal.find('.modal-body #tanggals').text(tgl)
    modal.find('.modal-body #jams').text(jam)
    modal.find('.modal-body #namabuss').text(bus)
    modal.find('.modal-body #rutebuss').text(rute)
    modal.find('.modal-body #nokursis').text(kursi)
    modal.find('.modal-body #hargas').text(harga)
    modal.find('.modal-body #tipebuss').text(tipe)
    modal.find('.modal-body #deskripsis').text(desc)
    modal.find('.modal-body #statuss').text(status)
  })
  // end detail transaksi sudah bayar
</script>


@endsection