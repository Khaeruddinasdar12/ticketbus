@extends('layouts.template')

@section('title')
Manajemen Bus
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Managemen Admin</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Managemen Admin</a></li>
          <!-- <li class="breadcrumb-item active">Dashboard v1</li> -->
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
  <div class="row">

    <div class="col-md-6">

      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Manage Admin</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>

        <!-- FORM TAMBAH BUS -->
        <div class="card-body">
          <form action="" method="POST">
            @csrf
            <div class="form-group">
              <label>Nama Admin</label>
              <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" class="form-control">
            </div>
            <div class="row">
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Ulangi Password</label>
                  <input type="password" name="password2" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="mail" name="email" class="form-control">
            </div>
            <div class="form-group">
              <label>Role Admin</label>
              <select class="form-control custom-select" name="roleadmin">
                <option selected disabled>Pilih Role</option>
                <option>Admin</option>
                <option>Kernet</option>
              </select>
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea name="alamat" class="form-control" rows="4"></textarea>
            </div>


            <div class="form-group">
              <button type="reset" class="btn btn-secondary float-left"><i class="nav-icon fas fa-sync-alt"></i> Reset</button>
              <button type="submit" class="btn btn-success float-right"><i class="nav-icon fas fa-plus"></i> Tambah</button>
            </div>
          </form>
        </div>

      </div>
    </div>
    <!-- /.card -->

    <div class="col-md-6">
      <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">Data Admin</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>

        <!-- FORM TAMBAH TIPE -->

        <div class="card-body">
          <table id="example4" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nama Admin</th>
                <th>Username</th>
                <th>Role</th>
                <th>Detail</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $datas)
              <tr>
                <td>{{$datas->name}}</td>
                <td>{{$datas->email}}</td>
                <td>Bintang Prima</td>
                <td> <button class="btn btn-primary" data-toggle="modal" data-target="#showdetail3">show</button> </td>
              </tr>
              @endforeach
            </tbody>
            <!-- Modal -->
            <div class="modal fade" id="showdetail3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <div class="col-md-10" style="margin: auto">
                          <div class="row">

                            <div class="col-md-5">
                              <h6>Nama Admin</h6>
                              <h6>Username</h6>
                              <h6>Email</h6>
                              <h6>Role Admin</h6>
                              <h6>Alamat</h6>
                            </div>

                            <div class="col-md-1">
                              <h6>:</h6>
                              <h6>:</h6>
                              <h6>:</h6>
                              <h6>:</h6>
                              <h6>:</h6>
                            </div>

                            <div class="col-md-6">
                              <h6>Baco Baco Becce Becce</h6>
                              <h6>Baco</h6>
                              <h6>baco@gmail.com</h6>
                              <h6>Karnet</h6>
                              <h6>Sudiang</h6>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </table>
        </div>
      </div>
      <!-- END FORM TAMBAH TIPE -->

      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </div>
</section>
@endsection

@section('js')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script>
  $(function() {
    $("#example4").DataTable();
  });
</script>
@endsection