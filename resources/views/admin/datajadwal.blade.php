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
                <table id="example0" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Nama Bus</th>
                      <th>Tipe Bus</th>
                      <th>Rute</th>
                      <th>Tanggal Berangkat</th>
                      <th>Jam Berangkat</th>
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
                      <td> <button class="btn btn-primary" data-toggle="modal" data-target="#showjadwal" title="lihat detail" data-nama="{{ $jadwal->namabus }}" data-tipe="{{ $jadwal->tipebus }}" data-rute="{{ $jadwal->rute }}" data-tgl="{{ $jadwal->tanggal }}" data-jam="{{ $jadwal->jam }}" data-desc="{{ $jadwal->deskripsi }}"><i class=" far fa-eye"></i></button> </td>
                      <td>
                        <button class="btn btn-success" data-toggle="modal" data-target="#editbus" title="edit data"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-danger" title="hapus data" onclick="hapus()" id="del_idbus"><i class="fas fa-trash"></i></button>
                      </td>
                    </tr>
                    @endforeach
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
<script>
  // detail pivot
  $('#showjadwal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var nama = button.data('nama')
    var tipe = button.data('tipe')
    var rute = button.data('rute')
    var tgl = button.data('tgl')
    var jam = button.data('jam')
    var desc = button.data('desc')

    var modal = $(this)
    modal.find('.modal-title').text('Detail Jadwal Bus ' + nama)
    modal.find('.modal-body #namabus').val(nama)
    modal.find('.modal-body #tipebus').val(tipe)
    modal.find('.modal-body #rutebus').val(rute)
    modal.find('.modal-body #tanggal').val(tgl)
    modal.find('.modal-body #jam').val(jam)
    modal.find('.modal-body #deskripsi').val(desc)
  })
  // end detail pivot
</script>

@endsection