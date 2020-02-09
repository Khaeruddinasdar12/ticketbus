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
                <table id="example0" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Nama Bus</th>
                      <th>Tipe Bus</th>
                      <th>Rute</th>
                      <th>Tanggal Berangkat</th>
                      <th>Jam Berangkat</th>
                      <th>Detail</th>
                    </tr>
                  </thead>
                  <tbody>                    
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#showjadwal" title="lihat detail"><i class=" far fa-eye"></i></button>
                      </td>
                    </tr>
                  </tbody>

                  <!-- Modal detail -->
                  <div class="modal fade" id="showjadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Detail Bus</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="container">
                            <form role="form">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Nama Bus</label>
                                <input type="text" class="form-control" id="namabus" readonly>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Tipe Bus</label>
                                <input type="text" class="form-control" id="tipebus" readonly>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Harga Per kursi</label>
                                <input type="text" class="form-control" id="harga" readonly>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Rute</label>
                                <input type="text" class="form-control" id="rutebus" readonly>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Tanggal Berangkat</label>
                                    <input type="text" class="form-control" id="tanggal" readonly>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Jam Berangkat</label>
                                    <input type="text" class="form-control" id="jam" readonly>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Deskripsi Bus</label>
                                <textarea name="desc" class="form-control" id="deskripsi" rows="4" readonly></textarea>
                              </div>

                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Modal detail -->

                  <!-- Modal edit -->
                  <div class="modal fade" id="editjadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="container">
                            <form role="form" action="" method="post" id="edit-jadwal">
                              @csrf
                              <input type="hidden" id="jadwal-id">
                              <input type="hidden" name="_method" value="PUT">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Nama Bus</label>
                                <input type="text" class="form-control" name="namabus" id="namabuss" readonly>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Tipe Bus</label>
                                <input type="text" class="form-control" name="tipebus" id="tipebuss" readonly>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Rute</label>
                                <input type="text" class="form-control" name="rute" id="rutebuss" readonly>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Harga Per kursi</label>
                                <input type="text" class="form-control" name="tipebus" id="hargas" readonly>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Tanggal Berangkat</label>
                                    <input type="date" class="form-control" name="tanggal" id="tanggals" required>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Jam Berangkat</label>
                                    <input type="text" class="form-control" name="jam" id="jams" required>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Deskripsi Bus</label>
                                <textarea name="desc" class="form-control" name="deskripsi" id="deskripsis" rows="4" readonly></textarea>
                              </div>

                              <div class="form-group" style="margin-top: 20px;">
                                <button type="submit" class="btn btn-primary float-right"><i class="nav-icon fas fa-plus"></i> Update</button>
                              </div>

                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Modal edit -->

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
    $("#example0").DataTable();
  });
</script>


@endsection