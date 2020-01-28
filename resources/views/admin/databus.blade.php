@extends('layouts.template')

@section('title')
Data Bus
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Bus</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Data Bus</a></li>
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
          <h3 class="card-title">
            <i class="fas fa-edit"></i>
            Data Bus
          </h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
          <h4>Pilih Data</h4>
          <div class="row">
            <div class="col-5 col-sm-3">
              <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="vert-tabs-add-tab" data-toggle="pill" href="#vert-tabs-add" role="tab" aria-controls="vert-tabs-add" aria-selected="true">Data Bus</a>
                <a class="nav-link" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="false">Data Tipe Bus</a>
                <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Data Route</a>
                <a class="nav-link" id="vert-tabs-pivot-tab" data-toggle="pill" href="#vert-tabs-pivot" role="tab" aria-controls="vert-tabs-pivot" aria-selected="false">Data pivot</a>
              </div>
            </div>
            <div class="col-7 col-sm-9">
              <div class="tab-content" id="vert-tabs-tabContent">
                <div class="tab-pane text-left fade show active" id="vert-tabs-add" role="tabpanel" aria-labelledby="vert-tabs-add-tab">
                  <form role="form">
                    <div class="form-group">
                      <label for="exampleInputName">Nama Customer</label>
                      <input type="text" class="form-control" id="exampleInputName" placeholder="Masukkan Nama">
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Waktu (jam) Berangkat</label>
                          <input type="text" class="form-control" placeholder="14.00 WITA">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Tanggal Berangkat</label>
                          <input type="date" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label for="inputStatus">Tipe Bus</label>
                          <select class="form-control custom-select">
                            <option selected disabled>Pilih tipe</option>
                            <option>Sleeper</option>
                            <option>Seatbelt</option>
                            <option>Comfortable</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="inputStatus">Nama Bus</label>
                          <select class="form-control custom-select">
                            <option selected disabled>Pilih tipe</option>
                            <option>Bintang Prima A10</option>
                            <option>Bintang Prima M70</option>
                            <option>Bintang Prima C30</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label for="inputStatus">Nomor Kursi</label>
                          <select class="form-control custom-select">
                            <option selected disabled>Pilih kursi</option>
                            <option>1A</option>
                            <option>2A</option>
                            <option>3A</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <!-- <a href="#" class="btn btn-secondary">Cancel</a> -->
                      <button type="reset" class="btn btn-secondary float-left"><i class="nav-icon fas fa-sync-alt"></i> Reset</button>
                      <button type="submit" class="btn btn-success float-right"><i class="nav-icon fas fa-plus"></i> Tambah</button>
                    </div>
                  </form>
                </div>
                <div class="tab-pane fade show" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nama Customer</th>
                        <th>Tgl Berangkat</th>
                        <th>Nama Bus</th>
                        <th>Status</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Baco</td>
                        <td>1 januari 1990</td>
                        <td>Bintang Prima</td>
                        <td> <button class="btn btn-danger" data-toggle="modal" data-target="#verif">Belum Bayar</button> </td>
                        <td> <button class="btn btn-primary" data-toggle="modal" data-target="#showdetail1">Show</button> </td>
                      </tr>
                    </tbody>
                    <!-- Modal -->
                    <div class="modal fade" id="verif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
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
                                <div class="col-md-12">
                                  <h6>Order Code</h6>
                                  <h5>123456 - example</h5>
                                  <hr>
                                  <h6>Bukti Pembayaran</h6>
                                  <div class="text-center">
                                    <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" alt="">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success">Verifikasi Pembayaran</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="showdetail1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                      <h6>Nomor Kursi</h6>
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
                                      <h6>:</h6>
                                    </div>

                                    <div class="col-md-6">
                                      <h6>Baco Baco Becce Becce</h6>
                                      <h6>Baco@gmail.com</h6>
                                      <h6>1 januari 1990</h6>
                                      <h6>Pukul 00:00 WITA</h6>
                                      <h6>Bintang Prima</h6>
                                      <h6>A3</h6>
                                      <h6>Rp. 10.000</h6>
                                      <h6>Full Stack Bus</h6>
                                      <h6>Belum Bayar</h6>
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
                <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                  <table id="example3" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nama Customer</th>
                        <th>Tgl Berangkat</th>
                        <th>Nama Bus</th>
                        <th>Status</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Baco</td>
                        <td>1 januari 1990</td>
                        <td>Bintang Prima</td>
                        <td>Sudah Bayar</td>
                        <td> <button class="btn btn-primary" data-toggle="modal" data-target="#showdetail2">show</button> </td>
                      </tr>
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
                                      <h6>Nomor Kursi</h6>
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
                                      <h6>:</h6>
                                    </div>

                                    <div class="col-md-6">
                                      <h6>Baco Baco Becce Becce</h6>
                                      <h6>Baco@gmail.com</h6>
                                      <h6>1 januari 1990</h6>
                                      <h6>Pukul 00:00 WITA</h6>
                                      <h6>Bintang Prima</h6>
                                      <h6>A3</h6>
                                      <h6>Rp. 10.000</h6>
                                      <h6>Full Stack Bus</h6>
                                      <h6>Sudah Bayar</h6>
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
                <div class="tab-pane fade" id="vert-tabs-pivot" role="tabpanel" aria-labelledby="vert-tabs-pivot-tab">
                  <table id="example4" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nama Customer</th>
                        <th>Tgl Berangkat</th>
                        <th>Nama Bus</th>
                        <th>Status</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Baco</td>
                        <td>1 januari 1990</td>
                        <td>Bintang Prima</td>
                        <td>Sudah Bayar</td>
                        <td> <button class="btn btn-primary" data-toggle="modal" data-target="#showdetail3">show</button> </td>
                      </tr>
                    </tbody>
                    <!-- Modal -->
                    <div class="modal fade" id="showdetail3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                      <h6>Nomor Kursi</h6>
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
                                      <h6>:</h6>
                                    </div>

                                    <div class="col-md-6">
                                      <h6>Baco Baco Becce Becce</h6>
                                      <h6>Baco@gmail.com</h6>
                                      <h6>1 januari 1990</h6>
                                      <h6>Pukul 00:00 WITA</h6>
                                      <h6>Bintang Prima</h6>
                                      <h6>A3</h6>
                                      <h6>Rp. 10.000</h6>
                                      <h6>Full Stack Bus</h6>
                                      <h6>Sudah Bayar</h6>
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
        </div>
        <!-- /.card -->
      </div>
    </div>

  </div>
</section>
@endsection

@section('js')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script>
  $(function() {
    $("#example1, #example2, #example3, #example4").DataTable();
  });
</script>
@endsection