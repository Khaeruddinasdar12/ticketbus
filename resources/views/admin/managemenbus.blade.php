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
        <h1 class="m-0 text-dark">Managemen Bus</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Managemen Bus</a></li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-6">
        <!-- general form elements -->

        <!-- tipe bus form -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Tambah Tipe Bus</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                </div>

              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <div class="card-body">
                <form role="form" action="" method="post" id="add-tipe">
                  @csrf
                  <div class="form-group">
                    <label for="tipebus">Nama Tipe</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="nama" required>
                      <span class="input-group-append">
                        <button type="submit" class="btn btn-info">Tambah</button>
                      </span>
                    </div>
                  </div>

                </form>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <!-- end tipe bus form -->

        <!-- rute form -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Tambah Rute</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                </div>

              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <div class="card-body">
                <form role="form" action="" method="post" id="add-rute">
                  @csrf

                  <div class="form-group">
                    <label for="tipebus">Nama Rute</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="rute" required>
                      <span class="input-group-append">
                        <button type="submit" class="btn btn-info">Tambah</button>
                      </span>
                    </div>
                  </div>

                </form>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <!-- end rute form -->

        <!-- /.card -->
      </div>
      <!--/.col (left) -->
      <!-- right column -->
      <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah Data Bus</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>

          </div>
          <!-- /.card-header -->
          <!-- form start -->

          <div class="card-body">
            <form role="form" action="" method="post" id="add-bus">
              @csrf
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Bus - Nomor Polisi (DD)</label>
                <input type="text" class="form-control" name="nama" required placeholder="ex: Bintang Prima - DD 1234 AA">
              </div>
              <div class="form-group">
                <label>Deskripsi Bus</label>
                <textarea class="form-control" rows="4" name="deskripsi" required></textarea>
              </div>
              <div class="form-group">
                <label>Tipe Bus</label>
                <select class="form-control custom-select" name="id_tipebus" required>
                  <option selected disabled>Pilih Tipe</option>
                  @foreach($tipebus as $tipe)
                  <option value="{{ $tipe->id }}">{{ $tipe->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Jumlah Kursi</label>
                <input type="text" class="form-control" id="kursi" name="jumlah_kursi" onkeypress="return hanyaAngka(event)" required>
              </div>

              <div class="form-group" style="margin-top: 45px;">
                <button type="reset" class="btn btn-secondary float-left"><i class="nav-icon fas fa-sync-alt"></i> Reset</button>
                <button type="submit" class="btn btn-primary float-right"><i class="nav-icon fas fa-plus"></i> Tambah</button>
              </div>

            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>

@endsection

@section('js')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script>
  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))

      return false;
    return true;
  }
</script>
<script>
  $(function() {
    $("#example4").DataTable();
  });
</script>
<script type="text/javascript">
  // add tipe bus
  $('#add-tipe').submit(function(e) {
    e.preventDefault();
    var request = new FormData(this);
    var endpoint = '{{route("store.tipebus")}}';
    $.ajax({
      url: endpoint,
      method: "POST",
      data: request,
      contentType: false,
      cache: false,
      processData: false,
      // dataType: "json",
      success: function(data) {
        $('#add-tipe')[0].reset();

        berhasil(data.status, data.pesan);
      },
      error: function(xhr, status, error) {
        var error = xhr.responseJSON;
        if ($.isEmptyObject(error) == false) {
          $.each(error.errors, function(key, value) {
            gagal(key, value);
          });
        }
      }
    });
  });
  // end tipe bus

  // add rute bus
  $('#add-rute').submit(function(e) {
    e.preventDefault();
    var request = new FormData(this);
    var endpoint = '{{route("store.rute")}}';
    $.ajax({
      url: endpoint,
      method: "POST",
      data: request,
      contentType: false,
      cache: false,
      processData: false,
      // dataType: "json",
      success: function(data) {
        $('#add-rute')[0].reset();

        berhasil(data.status, data.pesan);
      },
      error: function(xhr, status, error) {
        var error = xhr.responseJSON;
        if ($.isEmptyObject(error) == false) {
          $.each(error.errors, function(key, value) {
            gagal(key, value);
          });
        }
      }
    });
  });
  // end rute bus

  // add bus
  $('#add-bus').submit(function(e) {
    e.preventDefault();
    var request = new FormData(this);
    var endpoint = '{{route("store.bus")}}';
    $.ajax({
      url: endpoint,
      method: "POST",
      data: request,
      contentType: false,
      cache: false,
      processData: false,
      // dataType: "json",
      success: function(data) {
        $('#add-bus')[0].reset();

        berhasil(data.status, data.pesan);
      },
      error: function(xhr, status, error) {
        var error = xhr.responseJSON;
        if ($.isEmptyObject(error) == false) {
          $.each(error.errors, function(key, value) {
            gagal(key, value);
          });
        }
      }
    });
  });
  // end add bus
</script>
@endsection