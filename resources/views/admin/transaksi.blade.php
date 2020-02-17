@extends('layouts.template')

@section('title')
Transaksi
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Transaksi</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Data Transaksi</a></li>
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
          <h3 class="card-title">
            <i class="fas fa-edit"></i>
            Data Transaksi Customer
          </h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
          <h4>Status</h4>
          <div class="row">
            <div class="col-5 col-sm-3">
              <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">

                <a class="nav-link active" id="vert-tabs-add-tab" data-toggle="pill" href="#vert-tabs-add" role="tab" aria-controls="vert-tabs-add" aria-selected="true">Tambah Data Customer</a>

                <a class="nav-link" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="false">Belum Bayar</a>

              </div>
            </div>
            <div class="col-7 col-sm-9">
              <div class="tab-content" id="vert-tabs-tabContent">

                <div class="tab-pane text-left fade show active" id="vert-tabs-add" role="tabpanel" aria-labelledby="vert-tabs-add-tab">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Rute</th>
                        <th>Jam Berangkat</th>
                        <th>Tanggal Berangkat</th>
                        <th>Nama Bus</th>
                        <th>Tipe Bus</th>
                        <th>Harga Perkursi</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $datajadwal)
                      <tr>
                        <td>{{ $datajadwal -> rute }}</td>
                        <td>{{ $datajadwal -> jam }}</td>
                        <td>{{ $datajadwal -> tanggal }}</td>
                        <td>{{ $datajadwal -> namabus }}</td>
                        <td>{{ $datajadwal -> tipebus }}</td>
                        <td>Rp. {{ format_uang($datajadwal -> harga) }}</td>
                        <td> <button class="btn btn-primary" data-toggle="modal" id="pesankursi" data-target="#pesan" title="pesan kursi" onclick="kursi()" data-id="{{$datajadwal->id}}"><i class="fas fa-shopping-cart"></i></button> </td>
                      </tr>
                      @endforeach
                    </tbody>

                    <!-- Modal -->
                    <div class="modal fade" id="pesan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pesan Kursi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>

                          <div class="modal-body">
                            <div class="container">
                              <form id="transaksi-customer" method="POST">
                                @csrf
                                <input type="hidden" id="jadwal-id" name="id_jadwal">
                                <!-- <input type="hidden" name="_method" value="PUT"> -->
                                <div class="row">
                                  <div class="col-md-5 offset-md-1" style="border-right: 1px solid #c7c9ca">
                                    <div class="btn-group-toggle" data-toggle="buttons" id="pilih-kursi"></div>
                                  </div>
                                  <div class="col-md-5 m-auto">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Nomor Kursi</label>
                                      <input type="text" class="form-control" id="nmrkursi" name="no_kursi" readonly>
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Nama Customer</label>
                                      <input type="text" class="form-control" id="namabus" name="name">
                                    </div>
                                    <div class="form-group">
                                      <label>Jenis Kelamin</label>
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="icheck-primary d-inline">
                                            <input type="radio" id="radioPrimary1" name="jkel" value="L" checked>
                                            <label for="radioPrimary1">Laki-laki</label>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="icheck-primary d-inline">
                                            <input type="radio" id="radioPrimary2" name="jkel" value="P">
                                            <label for="radioPrimary2">Perempuan</label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group" style="margin-top: 20px;">
                                  <button type="reset" class="btn btn-default float-left" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary float-right">Pesan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </table>
                </div>

                <div class="tab-pane fade show" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                  <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nama Customer</th>
                        <th>Nama Bus</th>
                        <th>Tgl Berangkat</th>
                        <th>Jam Berangkat</th>
                        <th>Bukti</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($belum as $belumbayar)
                      <tr>
                        <td>{{$belumbayar->name}}</td>
                        <td>{{$belumbayar->namabus}}</td>
                        <td>{{$belumbayar->tanggal}}</td>
                        <td>{{$belumbayar->jam}}</td>

                        <td>
                          <button class="btn btn-danger" data-toggle="modal" data-target="#verif" title="belum bayar" data-id="{{ $belumbayar->id }}" data-order="{{ $belumbayar->order_code }}"
                          data-bukti="{{ asset('storage/'.$belumbayar->bukti_transfer) }}" data-nama="{{ $belumbayar->name }}" data-tgl="{{ $belumbayar->tanggal }}" data-jam="{{ $belumbayar->jam }}" data-bus="{{ $belumbayar->namabus }}" data-desc="{{ $belumbayar->deskripsi }}" data-rute="{{ $belumbayar->rute }}" data-tipe="{{ $belumbayar->tipebus }}" data-harga="Rp. {{ format_uang($belumbayar->harga) }}" data-kursi="{{ $belumbayar->no_kursi }}" data-status="{{ $belumbayar->status_bayar }}"><i class="fab fa-creative-commons-nc"></i></button>
                        </td>
                        
                        <td>
                          <button class="btn btn-primary" data-toggle="modal" data-target="#showdetail1" title="lihat detail" data-id="{{ $belumbayar->id }}" data-order="{{ $belumbayar->order_code }}" data-bukti="{{ asset('storage/'.$belumbayar->bukti_transfer) }}" data-nama="{{ $belumbayar->name }}" data-tgl="{{ $belumbayar->tanggal }}" data-jam="{{ $belumbayar->jam }}" data-bus="{{ $belumbayar->namabus }}" data-desc="{{ $belumbayar->deskripsi }}" data-rute="{{ $belumbayar->rute }}" data-tipe="{{ $belumbayar->tipebus }}" data-harga="Rp. {{ format_uang($belumbayar->harga) }}" data-kursi="{{ $belumbayar->no_kursi }}" data-status="{{ $belumbayar->status_bayar }}"><i class=" far fa-eye"></i></button>

                          <button title="Verifikasi Pembayaran" class="btn btn-success" id-transaksi="{{$belumbayar->id}}" id-user="{{$belumbayar->id_user}}" onclick="verified('verified')" id="verified"><i class="fas fa-check"></i></button>

                          <button title="Batalkan Transaksi" class="btn btn-danger" id-transaksi="{{$belumbayar->id}}" id-user="{{$belumbayar->id_user}}" onclick="cancel('cancel')" id="cancel"><i class="fas fa-window-close"></i></button>
                        </td>


                      </tr>
                      @endforeach
                    </tbody>
                    <!-- Modal Bukti Transfer -->
                    <div class="modal fade" id="verif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <div class="row">
                                  <div class="col-md-12">
                                    <h6>Order Code</h6>
                                    <h5 id="order"></h5>
                                    <hr>
                                    <h6>Bukti Pembayaran</h6>
                                    <div class="text-center">
                                      <img src="" alt="bukti transfer" id="bukti-transfer" width="70px" height="100px">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                      </div>
                    </div>
                    <!-- End modal bukti transfer -->

                    <div class="modal fade" id="showdetail1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="container">
                              <div class="row">
                                <div class="col-md-4" style="border-right: 1px solid #c7c9ca">
                                  <h6>Order Code</h6>
                                  <h5 id="order"></h5>
                                  <hr>
                                </div>
                                <div class="col-md-7 offset-md-1" style="margin: auto">
                                  <div class="row">

                                    <div class="col-md-5">
                                      <h6>Nama Customer</h6>
                                      <h6>Tanggal Berangkat</h6>
                                      <h6>Jam Berangkat</h6>
                                      <h6>Nama Bus</h6>
                                      <h6>Rute Bus</h6>
                                      <h6>Nomor Kursi</h6>
                                      <h6>Harga</h6>
                                      <h6>Tipe Bus</h6>
                                      <h6>Deskripsi</h6>
                                      <br>
                                      <h6>Status</h6>
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
                                      <h6>:</h6>
                                      <br>
                                      <h6>:</h6>
                                    </div>

                                    <div class="col-md-6">
                                      <h6 id="nama"></h6>
                                      <h6 id="tanggal"></h6>
                                      <h6 id="jam"></h6>
                                      <h6 id="namabus"></h6>
                                      <h6 id="rutebus"></h6>
                                      <h6 id="nokursi"></h6>
                                      <h6 id="harga"></h6>
                                      <h6 id="tipebus"></h6>
                                      <h6 id="deskripsi"></h6>
                                      <h6 id="status"></h6>
                                    </div>


                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </table>
                </div>

              </div>
            </div>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>

  </div>
</section>
@endsection

@section('js')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script>
  $(function() {
    $("#example2, #example3").DataTable();
  });

//edit status transaksi
  function verified(status) {
      $(document).on('click', "#verified", function() {
        Swal.fire({
          title: 'Anda Yakin ?',
          text: "Pastikan bukti pembayaran telah dicek!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Verifikasi!',
          timer: 6500
        }).then((result) => {
          if (result.value) {
            var me = $(this),
              id = me.attr('id-transaksi');
              url = 'verifikasi-bayar/verified/'+id,
              token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
              url: url,
              method: "POST",
              data: {
                '_method': 'PUT',
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

    function cancel(status) {
      $(document).on('click', "#cancel", function() {
        Swal.fire({
          title: 'Anda Yakin ?',
          text: "Anda tidak dapat mengembalikan data yang telah di hapus!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Lanjutkan Hapus!',
          timer: 6500
        }).then((result) => {
          if (result.value) {
            var me = $(this),
              url = me.attr('href'),
              token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
              url: url,
              method: "POST",
              data: {
                '_method': 'DELETE',
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
    //end edit status transaksi

  $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example1 thead tr').clone(true).appendTo('#example1 thead');
    $('#example1 thead tr:eq(1) th').each(function(i) {
      var title = $(this).text();
      $(this).html('<input type="text" placeholder="Search ' + title + '" />');

      $('input', this).on('keyup change', function() {
        if (table.column(i).search() !== this.value) {
          table
            .column(i)
            .search(this.value)
            .draw();
        }
      });
    });

    var table = $('#example1').DataTable({
      orderCellsTop: true,
      fixedHeader: true
    });
  });
</script>
<script>
  // verifikasi transaksi belum bayar
  $('#verif').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var order = button.data('order')
    var barcode = button.data('barcode')
    var nama = button.data('nama')
    var bukti = button.data('bukti')

    var modal = $(this)
    modal.find('.modal-title').text('Bukti Pembayaran ' + nama)
    modal.find('.modal-body #order').text(order)
    modal.find('.modal-body #nama').text(nama)
    modal.find('.modal-body #id_transaksi').val(id)
    modal.find('.modal-body #bukti-transfer').attr('src', bukti)
  })
  // end verifikasi transaksi belum bayar

  // detail transaksi belum bayar
  $('#showdetail1').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var bukti = button.data('bukti')
    var order = button.data('order')
    var nama = button.data('nama')
    var tgl = button.data('tgl')
    var jam = button.data('jam')
    var bus = button.data('bus')
    var desc = button.data('desc')
    var rute = button.data('rute')
    var tipe = button.data('tipe')
    var harga = button.data('harga')
    var kursi = button.data('kursi')
    var status = button.data('status')

    var modal = $(this)
    modal.find('.modal-title').text('Detail Transaksi ' + nama)
    modal.find('.modal-body #order').text(order)
    modal.find('.modal-body #nama').text(nama)
    modal.find('.modal-body #tanggal').text(tgl)
    modal.find('.modal-body #jam').text(jam)
    modal.find('.modal-body #namabus').text(bus)
    modal.find('.modal-body #rutebus').text(rute)
    modal.find('.modal-body #nokursi').text(kursi)
    modal.find('.modal-body #harga').text(harga)
    modal.find('.modal-body #tipebus').text(tipe)
    modal.find('.modal-body #deskripsi').text(desc)
    modal.find('.modal-body #status').text(status)
  })
  // end detail transaksi belum bayar

  // menampilkan harga dan deskripsi
  function kursi() {
    $(document).on('click', "#pesankursi", function() {
      // idJadwal = $(this).attr('data-id');
      var id = $(this).attr('data-id');
      $('#jadwal-id').val(id);
      console.log(id);
      $.ajax({
        'url': "cek-kursi/" + id,
        'dataType': 'json',
        success: function(data) {
          $('#pilih-kursi').empty();
          $('#nmrkursi').val('');
          $('#namabus').val('');

          jQuery.each(data, function(i, val) {

            var br = '';
            var span = '';
            var status = val.status;
            var bg = '';
            if (i == 3 || i == 7 || i == 11 || i == 15 || i == 19 || i == 23 || i == 27 || i == 31) {
              br = '<br>';
            }
            if (i == 1 || i == 5 || i == 9 || i == 13 || i == 17 || i == 21 || i == 25 || i == 29) {
              span = '<span class="ml-3"></span>';
            }
            if (status == 'kosong') {
              bg = '<label class="btn bg-danger kursi mb-1 ml-1" style="cursor: pointer" id="pilih-kursi"> <input type = "radio" name = "options" id = "option1" autocomplete = "off" onchange="nokursi(' + val.kursi + ')">' + val.kursi + '</label>';
            } else if (status == 'keranjang') {
              bg = '<label class="btn bg-primary disabled kursi mb-1 ml-1" id="pilih-kursi"> <input type = "radio" name = "options" id = "option1" autocomplete = "off">' + val.kursi + '</label>';
            } else {
              bg = '<label class="btn btn-secondary disabled kursi mb-1 ml-1" id="pilih-kursi"> <input type = "radio" name = "options" id = "option1" autocomplete = "off">' + val.kursi + '</label>';
            }
            $('#pilih-kursi').append(bg + span + br);

          });
        }
      })
    })
  }
  // end menampilkan harga dan deskripsi

  // nokursi
  function nokursi(kursi) {
    document.getElementById("nmrkursi").value = kursi;
    $('#nmrkursi').val(kursi);
  }
  // end nokursi

  // add transaksi
  $('#transaksi-customer').submit(function(e) {
    e.preventDefault();
    var request = new FormData(this);
    var endpoint = '{{route("store.transaksi")}}';
    $.ajax({
      url: endpoint,
      method: "POST",
      data: request,
      contentType: false,
      cache: false,
      processData: false,
      // dataType: "json",
      success: function(data) {
        $('#transaksi-customer')[0].reset();

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
</script>
<style type="text/css">
  thead input {
    width: 100%;
  }

  .kursi {
    width: 50px !important;
  }
</style>
@endsection