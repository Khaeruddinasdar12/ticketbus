@extends('layouts.template')

@section('title')
Jadwal
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Managemen Jadwal</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Managemen Jadwal</a></li>
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
          <h3 class="card-title">Tambah Jadwal</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form role="form">
            <div class="form-group">
              <label for="inputStatus">Rute Perjalanan</label>
              <select class="form-control custom-select">
                <option selected disabled>Pilih tipe</option>
                <option>Makassar - Palopp</option>
                <option>Makassar - Toraja</option>
                <option>Makassar - Masamba</option>
                <option>Masamba - Makassar</option>
                <option>Toraja - Makassar</option>
                <option>Palopo - Makassar</option>
              </select>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label>Waktu (jam)</label>
                  <input type="text" class="form-control" placeholder="14.00 WITA">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Tanggal</label>
                  <input type="date" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
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
              <div class="col-sm-6">
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
            </div>

            <div class="form-group">
              <label>Deskripsi Bus</label>
              <textarea class="form-control" rows="3" disabled></textarea>
            </div>

            <div class="form-group">
              <label for="inputName">Harga Rp. Per kursi</label>
              <input type="text" class="form-control" disabled>
            </div>

            <div class="form-group">
              <!-- <a href="#" class="btn btn-secondary">Cancel</a> -->
              <button type="reset" class="btn btn-secondary float-left"><i class="nav-icon fas fa-sync-alt"></i> Reset</button>
              <button type="submit" class="btn btn-success float-right"><i class="nav-icon fas fa-plus"></i> Tambah</button>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <div class="col-md-6">
      <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">Tambah Rute Perjalanan</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>

        <!-- FORM TAMBAH RUTE -->

        <div class="card-body">
          <form action="" method="">
            <div class="form-group">
              <label for="inputEstimatedBudget">Rute Perjalanan : </label>
              <input type="text" name="nama" class="form-control" placeholder="makassar-toraja">
            </div>

            <div class="form-group">
              <label for="inputStatus">Tipe Bus</label>
              <select class="form-control custom-select">
                <option selected disabled>Pilih tipe</option>
                <option>Sleeper</option>
                <option>Seatbelt</option>
                <option>Comfortable</option>
              </select>
            </div>

            <div class="form-group">
              <label for="inputProjectLeader">Harga Rp. Per kursi</label>
              <input type="text" name="harga" class="form-control">
            </div>

            <div class="form-group">
              <!-- <a href="#" class="btn btn-secondary">Cancel</a> -->
              <button type="reset" class="btn btn-secondary float-left"><i class="nav-icon fas fa-sync-alt"></i> Reset</button>
              <button type="submit" class="btn btn-success float-right"><i class="nav-icon fas fa-plus"></i> Tambah</button>

            </div>
          </form>
        </div>

        <!-- END FORM TAMBAH RUTE -->
        <!-- /.card-body -->
      </div>
      <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">Data Rute Perjalanan</h3>
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
                <th>Rute Perjalanan</th>
                <th>Tipe Bus</th>
                <th>Harga Rp. Per kursi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Makassar - Palopo</td>
                <td>Sleeper</td>
                <td>Rp. 150.000</td>
              </tr>
              <tr>
                <td>Makassar - Toraja</td>
                <td>Seatbelt</td>
                <td>Rp. 150.000</td>
              </tr>
              <tr>
                <td>Makassar - Masamba</td>
                <td>Sleeper</td>
                <td>Rp. 180.000</td>
              </tr>
              <tr>
                <td>Palopo - Makassar</td>
                <td>Sleeper</td>
                <td>Rp. 150.000</td>
              </tr>
            </tbody>
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