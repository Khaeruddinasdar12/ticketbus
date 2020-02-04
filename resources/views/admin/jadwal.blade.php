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
    <div class="col-md-12">
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
            <div class="row">
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label for="filter">Filter By</label>
                  <select class="form-control custom-select" name="pilihfilter">
                    <option selected disabled>Pilih filter</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Pilihan</label>
                  <select class="form-control custom-select" name="pilihan">
                    <option selected disabled>Hasil Pilihan</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="inputStatus">Rute Perjalanan</label>
              <select class="form-control custom-select" name="pilihrute">
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
                  <input type="text" class="form-control" placeholder="14.00 WITA" name="jam">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Tanggal</label>
                  <input type="date" class="form-control" name="tanggal">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label for="inputStatus">Tipe Bus</label>
                  <select class="form-control custom-select" name="pilihtipe">
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
                  <select class="form-control custom-select" name="pilihbus">
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
              <textarea class="form-control" rows="3" disabled id="deskripsi"></textarea>
            </div>

            <div class="form-group">
              <label for="inputName">Harga Rp. Per kursi</label>
              <input type="text" class="form-control" disabled id="harga">
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