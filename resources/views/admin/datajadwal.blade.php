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
          <h3 class="card-title">Data Jadwal</h3>
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
                <div class="table-responsive">
                  <table id="example0" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nama Bus</th>
                        <th>Tipe Bus</th>
                        <th>Rute</th>
                        <th>Tanggal Berangkat</th>
                        <th>Jam Berangkat</th>
                        <th>Kursi Kosong</th>
                        <th>Detail</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $jadwal)
                      <tr>
                        <td>{{ $jadwal->namabus }}</td>
                        <td>{{ $jadwal->tipebus }}</td>
                        <td>{{ $jadwal->rute }}</td>
                        <td>{{ $jadwal->tanggal }}</td>
                        <td>{{ $jadwal->jam }}</td>
                        <td>{{ $jadwal->kursi_kosong }}</td>
                        <td>
                          <button class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#showjadwal" title="lihat detail" data-id="{{ $jadwal->id }}" data-nama="{{ $jadwal->namabus }}" data-tipe="{{ $jadwal->tipebus }}" data-rute="{{ $jadwal->rute }}" data-tgl="{{ $jadwal->tanggal }}" data-jam="{{ $jadwal->jam }}" data-desc="{{ $jadwal->deskripsi }}" data-harga="Rp. {{ format_uang($jadwal->harga) }}"><i class=" far fa-eye"></i></button>
                        </td>
                        <td>
                          <button class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#editjadwal" title="edit data" data-id="{{ $jadwal->id }}" data-nama="{{ $jadwal->namabus }}" data-tipe="{{ $jadwal->tipebus }}" data-rute="{{ $jadwal->rute }}" data-tgl="{{ $jadwal->tanggal }}" data-jam="{{ $jadwal->jam }}" data-desc="{{ $jadwal->deskripsi }}" data-harga="Rp. {{ format_uang($jadwal->harga) }}"><i class="fas fa-pencil-alt"></i></button>

                          <button class="btn btn-outline-danger btn-sm" title="hapus data" href="managemen-jadwal/delete-jadwal/{{$jadwal->id}}" onclick="hapus()" id="del_data"><i class="fas fa-trash"></i></button>

                          <button class="btn btn-outline-dark btn-sm" title="Bus Dalam Perjalanan" href="managemen-jadwal/edit-status/{{$jadwal->status}}/{{$jadwal->id}}" onclick="status('Bus yang anda pilih akan di berangkatkan ?')" id="status_perjalanan"><i class="fas fa-road"></i></button>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>

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
                                      <input required type="date" class="form-control" name="tanggal" id="tanggals" min="<?php echo date('Y-m-d'); ?>" />
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Jam Berangkat</label>
                                      <div class="input-group date" id="timepicker" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input jams" name="jam" data-target="#timepicker" required />
                                        <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                      </div>
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
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</section>
<!-- Modal detail -->
<div class="modal fade" id="showjadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Bus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Konten -->
        <div class="row">
          <div class="col-md-10 offset-1">
            <table class="table-modal">
              <tr>
                <th class="width-0">Nama Bus</th>
                <td class="width-1">:</td>
                <td id="namabus"></td>
              </tr>
              <tr>
                <th class="width-0">Tipe Bus</th>
                <td class="width-1">:</td>
                <td id="tipebus"></td>
              </tr>
              <tr>
                <th class="width-0">Harga Perkursi</th>
                <td class="width-1">:</td>
                <td id="harga"></td>
              </tr>
              <tr>
                <th class="width-0">Rute</th>
                <td class="width-1">:</td>
                <td id="rutebus"></td>
              </tr>
              <tr>
                <th class="width-0">Tanggal Berangkat</th>
                <td class="width-1">:</td>
                <td id="tanggal"></td>
              </tr>
              <tr>
                <th class="width-0">Jam Berangkat</th>
                <td class="width-1">:</td>
                <td id="jam"></td>
              </tr>
              <tr>
                <th class="width-0">Deskripsi Bus</th>
                <td class="width-1">:</td>
                <td id="deskripsi"></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- End Konten -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<style>
  .width-0 {
    width: 120px !important;
  }

  .table-modal {
    line-height: 40px !important;
    width: 700px;
  }

  .width-1 {
    width: 50px !important;
  }
</style>
<!-- End Modal detail -->
@endsection

@section('js')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script>
  $(function() {
    $("#example0").DataTable();
  });
</script>
<script>
  //Timepicker
  $('#timepicker').datetimepicker({
    format: 'HH:mm'
  })
  // end timepicker

  // detail jadwal
  $('#showjadwal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var nama = button.data('nama')
    var tipe = button.data('tipe')
    var rute = button.data('rute')
    var tgl = button.data('tgl')
    var jam = button.data('jam')
    var desc = button.data('desc')
    var harga = button.data('harga')

    var modal = $(this)
    modal.find('.modal-title').text('Detail Jadwal Bus ' + nama)
    modal.find('.modal-body #namabus').text(nama)
    modal.find('.modal-body #tipebus').text(tipe)
    modal.find('.modal-body #rutebus').text(rute)
    modal.find('.modal-body #tanggal').text(tgl)
    modal.find('.modal-body #jam').text(jam)
    modal.find('.modal-body #deskripsi').text(desc)
    modal.find('.modal-body #harga').text(harga)
  })
  // end detail jadwal

  // edit jadwal
  $('#editjadwal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var nama = button.data('nama')
    var tipe = button.data('tipe')
    var rute = button.data('rute')
    var tgl = button.data('tgl')
    var jam = button.data('jam')
    var desc = button.data('desc')
    var id = button.data('id')
    var harga = button.data('harga')

    var modal = $(this)
    modal.find('.modal-title').text('Edit Jadwal Bus ' + nama)
    modal.find('.modal-body #jadwal-id').val(id)
    modal.find('.modal-body #namabuss').val(nama)
    modal.find('.modal-body #tipebuss').val(tipe)
    modal.find('.modal-body #rutebuss').val(rute)
    modal.find('.modal-body #tanggals').val(tgl)
    modal.find('.modal-body .jams').val(jam)
    modal.find('.modal-body #deskripsis').val(desc)
    modal.find('.modal-body #hargas').val(harga)
  })
  // end edit jadwal

  // JQUERY FORM EDIT
  //edit data bus
  $('#edit-jadwal').submit(function(e) {
    e.preventDefault();
    var id = eval(document.getElementById('jadwal-id').value); //id pada inputan
    console.log(id);
    var request = new FormData(this);
    var endpoint = "managemen-jadwal/edit-jadwal/" + id;
    $.ajax({
      url: endpoint,
      method: "POST",
      data: request,
      contentType: false,
      cache: false,
      processData: false,
      // dataType: "json",
      success: function(data) {
        $('#edit-jadwal')[0].reset(); //id form
        $('#editjadwal').modal('hide'); //id modal
        console.log(data.pesan);
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
  // end edit data bus
  // END JQUERY FORM EDIT
</script>

@endsection