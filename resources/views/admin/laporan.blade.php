@extends('layouts.template')

@section('title')
Laporan
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Laporan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Laporan</li>
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
          <h3 class="card-title">Laporan <b style=" text-transform: uppercase">{{$keterangan}}</b></h3>
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
                  <div class="row">
                  <div class="col-sm-2" >
                    <form action="{{route('index.laporan')}}" method="GET">
                  <select class="form-control form-control-sm" name="year" required="" id="year">
                    <option value="">-- Pilih Tahun --</option>
                    @foreach($tahun as $tahuns)
                    <option value="{{$tahuns->date}}" @if($tahuns->date == $year) {{'selected'}} @endif> {{$tahuns->date}} </option>
                    @endforeach
                  </select>
                </div>
                <div class="col-sm-2" >
                  <select class="form-control form-control-sm" name="month" id="month">
                    <option value="">-- Pilih Bulan --</option>
                    <option value="1" @if($month == "Januari") {{"selected"}} @endif>Januari</option>
                    <option value="2" @if($month == "Februari") {{"selected"}} @endif>Februari</option>
                    <option value="3" @if($month == "Maret") {{"selected"}} @endif>Maret</option>
                    <option value="4" @if($month == "April") {{"selected"}} @endif>April</option>
                    <option value="5" @if($month == "Mei") {{"selected"}} @endif>Mei</option>
                    <option value="6" @if($month == "Juni") {{"selected"}} @endif>Juni</option>
                    <option value="7" @if($month == "Juli") {{"selected"}} @endif>Juli</option>
                    <option value="8" @if($month == "Agustus") {{"selected"}} @endif>Agustus</option>
                    <option value="9" @if($month == "September") {{"selected"}} @endif>September</option>
                    <option value="10" @if($month == "Oktober") {{"selected"}} @endif>Oktober</option>
                    <option value="11" @if($month == "November") {{"selected"}} @endif>November</option>
                    <option value="12" @if($month == "Desember") {{"selected"}} @endif>Desember</option>
                  </select>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-outline-info btn-sm"><i class="fas fa-sync-alt"></i></button>
                </div>
                </form>
                <div class="col-sm-6">
                  <form action="{{route('download.laporan')}}" method="GET">
                    <input type="hidden" name="month" value="{{$bulan}}">
                    <input type="hidden" name="year" value="{{$year}}">
                <button type="submit" class="btn btn-outline-danger btn-sm float-right">
                    <i class="fas fa-file-pdf"></i> PDF
                  </button>
                  </form>
                  </div>
                </div>

                <br>
                <div class="table-responsive">
                  <table id="" class="table table-hover">
                    <thead>
                      <tr>
                        <th>Nama Bus</th>
                        <th>Tipe Bus</th>
                        <th>Rute</th>
                        <th>Tanggal Berangkat</th>
                        <th>Jam Berangkat</th>
                        <th>Tanggal Tiba</th>
                        <th>Jam Tiba</th>
                        <th>Kursi Terisi</th>
                        <th>Sub Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $datas)
                      <tr>
                        <td>{{$datas->namabus}}</td>
                        <td>{{$datas->tipebus}}</td>
                        <td>{{$datas->rute}}</td>
                        <td>{{$datas->tanggal}}</td>
                        <td>{{$datas->jam}} WITA</td>
                        <td>{{ date('Y-m-d', strtotime($datas->arrived_at)) }}</td>
                        <td>{{ date('H:i', strtotime($datas->arrived_at)) }} WITA</td>
                        <td>{{$datas->kursi_terisi}}</td>
                        <td>Rp. {{format_uang($datas->sub_total)}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="8" align="center" ><b>Total : </b></td>
                        <td><b>Rp. {{format_uang($total)}}</b></td>
                      </tr>
                    </tfoot>
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
                  <th class="width-0">Kursi Terisi</th>
                  <td class="width-1">:</td>
                  <td id="kursi"></td>
                </tr>
                <tr>
                  <th class="width-0">Harga Per Kursi </th>
                  <td class="width-1">:</td>
                  <td id="harga"></td>
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
</div>

<!-- End Modal Detail -->
@endsection

@section('js')

<script type="text/javascript">
  function download() {
    var month = eval(document.getElementById("month").value);
    var year = document.getElementById("year").value;

    switch(month) {
      case 1 :
      bulan = 'Januari';
      break;

      case 2 :
      bulan = 'Februari';
      break;

      case 3 :
      bulan = 'Maret';
      break;

      case 4 :
      bulan = 'April';
      break;

      case 5 :
      bulan = 'Mei';
      break;

      case 6 :
      bulan = 'Juni';
      break;

      case 7 :
      bulan = 'Juli';
      break;

      case 8 :
      bulan = 'Agustus';
      break;

      case 9 :
      bulan = 'September';
      break;

      case 10 :
      bulan = 'Oktober';
      break;

      case 11 :
      bulan = 'November';
      break;

      case 12 :
      bulan = 'Desember';
      break;

      default :
      bulan = "";
    }
    $(document).on('click', "#download", function() {
        Swal.fire({
          title: 'Download ? ',
          text: "Anda akan mengunduh Laporan " + bulan + " " + year,
          type: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Download!',
          timer: 6500
        }).then((result) => {
          if (result.value) {
            var me = $(this),
              url = '/download',
              token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
              url: url,
              method: "GET",
              data: {
                '_method': 'GET',
                '_token': token
              },
              success: function(data) {
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
          }
        });
      });

  }
</script>


@endsection