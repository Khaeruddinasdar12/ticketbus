@extends('layouts.template')

@section('title')
Dalam Perjalanan
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
          <li class="breadcrumb-item active">Dalam Perjalanan</li>
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
          <h3 class="card-title">Bus Dalam Perjalanan</h3>
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
                        <th>Kursi Terisi</th>
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
                        <td>{{ $jadwal->kursi_terisi }}</td>
                        <td> <button class="btn btn-outline-primary" data-toggle="modal" data-target="#detail" title="lihat detail" data-nama="{{$jadwal->namabus}}" data-tipe="{{$jadwal->tipebus}}" data-rute="{{$jadwal->rute}}" data-tanggal="{{$jadwal->tanggal}}" data-jam="{{$jadwal->jam}}" data-kursi="{{$jadwal->kursi_terisi}}" data-harga="Rp. {{format_uang($jadwal->harga)}}" data-deskripsi="{{$jadwal->deskripsi}}"><i class=" far fa-eye"></i></button> </td>
                        <td>
                          <button class="btn btn-outline-danger" title="Bus Telah Sampai" href="edit-status/{{$jadwal->status}}/{{$jadwal->id}}" onclick="status('Perjalanan bus ini telah selesai ?')" id="status_perjalanan"><i class="fas fa-clipboard-check"></i></button>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
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

<!-- Modal -->
<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
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
            <div class="col-md-12 offset-md-1" style="margin: auto">
              <div class="row">

                <div class="col-md-5">
                  <h6>Nama Bus</h6>
                  <h6>Tipe Bus</h6>
                  <h6>Rute Bus</h6>
                  <h6>Tanggal Berangkat</h6>
                  <h6>Jam Berangkat</h6>
                  <h6>Kursi Terisi</h6>
                  <h6>Harga Per kursi</h6>
                  <h6>Deskripsi</h6>
                </div>

                <div class="col-md-1">
                  <h6>:</h6>
                  <h6>:</h6>
                  <h6>:</h6>
                  <h6>:</h6>
                  <h6>:</h6>
                  <h6>:</h6>
                  <h6>:</h6>
                  <h6>:</h6>
                </div>

                <div class="col-md-6">
                  <h6 id="namabus"></h6>
                  <h6 id="tipebus"></h6>
                  <h6 id="rutebus"></h6>
                  <h6 id="tanggal"></h6>
                  <h6 id="jam"></h6>
                  <h6 id="kursi"></h6>
                  <h6 id="harga"></h6>
                  <h6 id="deskripsi"></h6>
                </div>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Detail -->
@endsection

@section('js')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script>
  $(function() {
    $("#example0").DataTable();
  });

  // detail jadwal
  $('#detail').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var nama = button.data('nama')
    var tipe = button.data('tipe')
    var rute = button.data('rute')
    var tgl = button.data('tanggal')
    var jam = button.data('jam')
    var desc = button.data('deskripsi')
    var kursi = button.data('kursi')
    var harga = button.data('harga')

    var modal = $(this)
    modal.find('.modal-title').text('Detail Jadwal Bus Dalam Perjalanan')
    modal.find('.modal-body #namabus').text(nama)
    modal.find('.modal-body #tipebus').text(tipe)
    modal.find('.modal-body #rutebus').text(rute)
    modal.find('.modal-body #tanggal').text(tgl)
    modal.find('.modal-body #jam').text(jam)
    modal.find('.modal-body #deskripsi').text(desc)
    modal.find('.modal-body #harga').text(harga)
    modal.find('.modal-body #kursi').text(kursi)
  })
  // end detail jadwal
</script>

@endsection