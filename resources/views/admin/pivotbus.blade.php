@extends('layouts.template')

@section('title')
Jalur Bus
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
      <div class="col-md-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Tambah Pivot</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>

          </div>
          <!-- /.card-header -->
          <!-- form start -->

          <div class="card-body">
            <form role="form" action="{{route('store.pivot')}}" method="post" id="add-pivot">
              @csrf
              <div class="row">
                <div class="col-sm-4">
                  <!-- text input -->
                  <div class="form-group">
                    <label for="inputStatus">Tipe Bus</label>
                    <select class="form-control custom-select" id="tipebus" onchange="show_tipe()" required>
                      <option selected disabled>Pilih tipe</option>
                      @foreach($tipebus as $tipe)
                      <option value="{{$tipe->id}}">{{$tipe->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="inputStatus">Nama Bus</label>
                    <select class="form-control custom-select" id="nama-bus" required name="id_bus">
                      <option selected disabled>Pilih tipe</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="inputStatus">Route</label>
                    <select class="form-control custom-select" required name="id_rute">
                      <option selected disabled>Pilih tipe</option>
                      @foreach($rute as $rutes)
                      <option value="{{$rutes->id}}">{{$rutes->rute}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="inputStatus">Harga Rp. Perkursi</label>
                <input type="text" class="form-control" name="harga" onkeypress="return hanyaAngka(event)">
              </div>

              <div class="form-group">
                <button type="reset" class="btn btn-secondary float-left"><i class="nav-icon fas fa-sync-alt"></i> Reset</button>
                <button type="submit" class="btn btn-info float-right"><i class="nav-icon fas fa-plus"></i> Tambah</button>
              </div>

            </form>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
    <!-- end pivot form -->
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
  // menampilkan bus setelah memilih tipe bus
  function show_tipe() {
    $('#nama-bus').empty();
    var id = $('#tipebus').val();
    $.ajax({
      'url': "show-bus/" + id,
      'dataType': 'json',
      success: function(data) {
        jQuery.each(data, function(i, val) {
          console.log(val.id);
          // $('#nama-bus').empty();
          $('#nama-bus').append('<option value="' + val.id + '">' + val.nama + '</option>');
        });
      }
    })
  }
  //end menampilkan bus setelah memilih tipe bus

  // Tambah data pivot
  $('#add-pivot').submit(function(e) {
    e.preventDefault();
    var request = new FormData(this);
    var endpoint = '{{route("store.pivot")}}';
    $.ajax({
      url: endpoint,
      method: "POST",
      data: request,
      contentType: false,
      cache: false,
      processData: false,
      // dataType: "json",
      success: function(data) {
        $('#add-pivot')[0].reset()
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
  // End tambah data pivot
</script>
@endsection