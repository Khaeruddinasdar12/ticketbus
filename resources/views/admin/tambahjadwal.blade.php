@extends('layouts.template')

@section('title')
Tambah Jadwal
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
          <li class="breadcrumb-item active">tambah jadwal</li>
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
          <form role="form" method="post" id="add-jadwal">
            @csrf
            <div class="row">
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label for="filter">Filter By</label>
                  <select class="form-control custom-select" name="pilihfilter" id="filteredby" onchange="show_filter()">
                    <option selected>Pilih filter</option>
                    <option value="rute">Rute</option>
                    <option value="tipe">Tipe</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Pilihan</label>
                  <select class="form-control custom-select" name="pilihan" id="hasil-pilih" onchange="hasil_filter()">
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputStatus">Rute Perjalanan</label>
                  <select class="form-control custom-select" name="id_bus_rute" id="pilih-rute" onchange="showdesc()" required>
                    <option>--Select--</option>
                    @foreach($data as $datas)
                    <option value="{{$datas->id}}">{{$datas->tipebus}} / {{$datas->nama}} / {{$datas->rute}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <div class="bootstrap-timepicker">
                        <div class="form-group">
                          <label>Jam</label>
                          <div class="input-group date" id="timepicker" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#timepicker" name="jam" id="jam" data-toggle="datetimepicker" onkeypress="return hanyaAngka(event)" placeholder="00:00 WITA"/>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Tanggal</label>
                      <input required type="date" class="form-control" name="tanggal" id="tanggal" min="<?php echo date('Y-m-d'); ?>" />
                      <!-- <input type="date" class="form-control" name="tanggal" id="tanggal"> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="inputName">Harga Rp. Per kursi</label>
              <input type="text" class="form-control" disabled id="harga-kursi">
            </div>

            <div class="form-group">
              <label>Deskripsi Bus</label>
              <textarea class="form-control" rows="3" disabled id="deskripsis"></textarea>
            </div>

            <div class="form-group">
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
  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))

      return false;
    return true;
  }
</script>
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
<script>
  //Timepicker
  $('#timepicker').datetimepicker({
    format: 'HH:mm'
  })
  // end timepicker

  // menampilkan pilihan setelah memilih filter
  function show_filter() {
    $('#hasil-pilih').empty();
    $("#hasil-pilih").append("<option>--Select--</option>");
    $('#pilih-rute').empty();
    $("#pilih-rute").append("<option>--Select--</option>");
    $("#deskripsis").val(" ");
    $('#harga-kursi').val(" ");
    $("#jam").val(" ");
    $('#tanggal').val(" ");
    tipe = $('#filteredby').val();
    $.ajax({
      'url': "filterby/" + tipe,
      'dataType': 'json',
      success: function(data) {
        jQuery.each(data, function(i, val) {
          $('#hasil-pilih').append('<option value="' + val.id + '">' + val.nama + '</option>');
        });
      }
    })
  }
  //end menampilkan pilihan setelah memilih filter

  // menampilkan pilihan setelah memilih hasil filter
  function hasil_filter() {
    $('#pilih-rute').empty();
    $("#pilih-rute").append("<option>--Select--</option>");
    $("#deskripsis").val(" ");
    $('#harga-kursi').val(" ");
    $("#jam").val(" ");
    $('#tanggal').val(" ");
    tipe = $('#filteredby').val();
    id = $('#hasil-pilih').val();
    $.ajax({
      'url': "show-rute-perjalanan/" + tipe + "/" + id,
      'dataType': 'json',
      success: function(data) {
        jQuery.each(data, function(i, val) {
          $('#pilih-rute').append('<option value="' + val.id + '">' + val.filter + ' / ' + val.data1 + ' / ' +
            val.data2 + '</option>');
        });
      }
    })
  }
  // end menampilkan pilihan setelah memilih hasil filter

  // menampilkan harga dan deskripsi
  function showdesc() {
    id = $('#pilih-rute').val();
    console.log(id);
    $.ajax({
      'url': "deskripsi-bus/" + id,
      'dataType': 'json',
      success: function(data) {
        console.log(data);
        jQuery.each(data, function(i, val) {
          harga = 'Rp. ' + new Intl.NumberFormat('de-ID', {
            style: 'currency',
            currency: 'IDN'
          }).format(val.harga);
          $('#harga-kursi').val(harga);
          $('#deskripsis').val(val.deskripsi);
        });
      }
    })
  }
  // end menampilkan harga dan deskripsi
</script>

<script>
  // add jadwal
  $('#add-jadwal').submit(function(e) {
    e.preventDefault();
    var request = new FormData(this);
    var endpoint = '{{route("store.jadwal")}}';
    $.ajax({
      url: endpoint,
      method: "POST",
      data: request,
      contentType: false,
      cache: false,
      processData: false,
      // dataType: "json",
      success: function(data) {
        $('#add-jadwal')[0].reset();

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
  // end jadwal
</script>
@endsection