@extends('layouts.template')

@section('title')
Riwayat Jadwal
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
          <li class="breadcrumb-item active">riwayat perjalanan</li>
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
          <h3 class="card-title">Riwayat Perjalanan</h3>
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
                    @foreach($data as $riwayat)
                    <tr>
                      <td>{{ $riwayat->namabus }}</td>
                      <td>{{ $riwayat->tipebus }}</td>
                      <td>{{ $riwayat->rute }}</td>
                      <td>{{ $riwayat->tanggal }}</td>
                      <td>{{ $riwayat->jam }}</td>
                      <td>
                        <button class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#showjadwal" title="lihat detail" data-id="{{ $riwayat->id }}" data-nama="{{ $riwayat->namabus }}" data-tipe="{{ $riwayat->tipebus }}" data-rute="{{ $riwayat->rute }}" data-tgl="{{ $riwayat->tanggal }}" data-jam="{{ $riwayat->jam }} WITA" data-desc="{{ $riwayat->deskripsi }}" data-harga="Rp. {{ format_uang($riwayat->harga) }}" data-tglsampai="{{ date('Y-m-d', strtotime($riwayat->arrived_at)) }}" data-jamsampai="{{ date('H:i', strtotime($riwayat->arrived_at)) }} WITA"><i class=" far fa-eye"></i></button>
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

<!-- Modal detail -->
<div class="modal fade" id="showjadwal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi Anda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"> &times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Konten -->
        <div class="row">
          <div class="col-md-10 offset-1">
            <table class="table-modal">
              <tr>
                <th>Nama Bus</th>
                <td class="width-1">:</td>
                <td id="namabus"></td>
              </tr>
              <tr>
                <th>Tipe Bus</th>
                <td class="width-1">:</td>
                <td id="tipebus"></td>
              </tr>
              <tr>
                <th>Harga Perkursi</th>
                <td class="width-1">:</td>
                <td id="harga"></td>
              </tr>
              <tr>
                <th>Rute</th>
                <td class="width-1">:</td>
                <td id="rutebus"></td>
              </tr>
              <tr>
                <th>Tanggal Berangkat</th>
                <td class="width-1">:</td>
                <td id="tanggalberangkat"></td>
              </tr>
              <tr>
                <th>Jam Berangkat</th>
                <td class="width-1">:</td>
                <td id="jamberangkat"></td>
              </tr>
              <tr>
                <th>Tanggal Sampai</th>
                <td class="width-1">:</td>
                <td id="tanggalsampai"></td>
              </tr>
              <tr>
                <th>Jam Sampai</th>
                <td class="width-1">:</td>
                <td id="jamsampai"></td>
              </tr>
              <tr>
                <th>Deskripsi Bus</th>
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
  // detail jadwal
  $('#showjadwal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var nama = button.data('nama')
    var tipe = button.data('tipe')
    var rute = button.data('rute')
    var tanggalberangkat = button.data('tgl')
    var jamberangkat = button.data('jam')
    var tanggalsampai = button.data('tglsampai')
    var jamsampai = button.data('jamsampai')
    var desc = button.data('desc')
    var harga = button.data('harga')

    var modal = $(this)
    modal.find('.modal-title').text('Detail Jadwal Bus ' + nama)
    modal.find('.modal-body #namabus').text(nama)
    modal.find('.modal-body #tipebus').text(tipe)
    modal.find('.modal-body #rutebus').text(rute)
    modal.find('.modal-body #tanggalberangkat').text(tanggalberangkat)
    modal.find('.modal-body #jamberangkat').text(jamberangkat)
    modal.find('.modal-body #tanggalsampai').text(tanggalsampai)
    modal.find('.modal-body #jamsampai').text(jamsampai)
    modal.find('.modal-body #deskripsi').text(desc)
    modal.find('.modal-body #harga').text(harga)
  })
  // end detail jadwal
</script>
@endsection