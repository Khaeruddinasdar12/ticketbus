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
                      <td> <button class="btn btn-primary" data-toggle="modal" data-target="#showdetail0" title="lihat detail"><i class=" far fa-eye"></i></button> </td>
                      <td>
                        <button class="btn btn-success" data-toggle="modal" data-target="#editbus" title="edit data"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-danger" title="hapus data" onclick="hapus()" id="del_idbus"><i class="fas fa-trash"></i></button>
                        <button class="btn btn-danger" title="Bus Telah Sampai" href="managemen-jadwal/edit-status/{{$jadwal->status}}/{{$jadwal->id}}" onclick="status()" id="status_perjalanan"><i class="fas fa-trash"></i></button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>



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

@endsection