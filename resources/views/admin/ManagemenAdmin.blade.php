@extends('layouts.template')

@section('title')
Manajemen Admin
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Managemen Admin</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Managemen Admin</a></li>
          <!-- <li class="breadcrumb-item active">Dashboard v1</li> -->
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
  <div class="row">

    <div class="col-md-6">

      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Manage Admin</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>

        <!-- FORM TAMBAH BUS -->
        <div class="card-body">
          <form action="" method="POST" id="add-admin">
            @csrf
            <div class="form-group">
              <label>Nama Admin</label>
              <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="mail" name="email" class="form-control">
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group">
              <label>Role Admin</label>
              <select class="form-control custom-select" name="role">
                <option selected disabled>Pilih Role</option>
                <option value="superadmin">Admin</option>
                <option value="kernet">Kernet</option>
              </select>
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
            <div class="row">
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" id="password1">
                  <i class="form-control-feedback"></i>
                  <span class="text-warning"></span>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Ulangi Password</label>
                  <input type="password" name="password2" class="form-control" id="password2" required>
                  <i class="form-control-feedback"></i>
                  <span class="text-warning"></span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label>Alamat</label>
              <textarea name="alamat" class="form-control" rows="4"></textarea>
            </div>


            <div class="form-group">
              <button type="reset" class="btn btn-secondary float-left"><i class="nav-icon fas fa-sync-alt"></i> Reset</button>
              <button type="submit" class="btn btn-success float-right"><i class="nav-icon fas fa-plus"></i> Tambah</button>
            </div>
          </form>
        </div>

      </div>
    </div>
    <!-- /.card -->

    <div class="col-md-6">
      <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">Data Admin</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>

        <!-- FORM TAMBAH TIPE -->

        <div class="card-body">
          <div class="table-responsive">
            <table id="example4" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nama Admin</th>
                  <th>Role</th>
                  <th>Detail</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $datas)
                <tr>
                  <td>{{$datas->name}}</td>
                  <td>{{$datas->role}}</td>
                  <td> <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#detailadmin" data-name="{{$datas->name}}" data-email="{{$datas->email}}" data-role="{{$datas->role}}" data-alamat="{{$datas->alamat}}"><i class=" far fa-eye"></i></button> </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- END FORM TAMBAH TIPE -->
      <!-- Modal -->
      <div class="modal fade" id="detailadmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
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
                  <div class="col-md-10" style="margin: auto">
                    <div class="row">

                      <div class="col-md-5">
                        <h6>Nama Admin</h6>
                        <h6>Email</h6>
                        <h6>Role Admin</h6>
                        <h6>Alamat</h6>
                      </div>

                      <div class="col-md-1">
                        <h6>:</h6>
                        <h6>:</h6>
                        <h6>:</h6>
                        <h6>:</h6>
                      </div>

                      <div class="col-md-6">
                        <h6 id="name"></h6>
                        <h6 id="email"></h6>
                        <h6 id="role"></h6>
                        <h6 id="alamat"></h6>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </div>
</section>
@endsection

@section('js')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script>
  $(function() {
    $("#example4").DataTable();
  });

  $('#detailadmin').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var name = button.data('name')
    var role = button.data('role')
    var email = button.data('email')
    var alamat = button.data('alamat')

    var modal = $(this)
    modal.find('.modal-title').text('Detail Admin ' + name)
    modal.find('.modal-body #name').text(name)
    modal.find('.modal-body #role').text(role)
    modal.find('.modal-body #email').text(email)
    modal.find('.modal-body #alamat').text(alamat)
  })

  // add admin
  $('#add-admin').submit(function(e) {
    pw1 = document.getElementById("password1").value;
    pw2 = document.getElementById("password2").value;
    e.preventDefault();
    if(pw1 != pw2) {
      gagal('Password', 'Konfirmasi password tidak sama');
    } else {
      var request = new FormData(this);
      var endpoint = '{{route("store.admin")}}';
      $.ajax({
        url: endpoint,
        method: "POST",
        data: request,
        contentType: false,
        cache: false,
        processData: false,
        // dataType: "json",
        success: function(data) {
          $('#add-admin')[0].reset();

          berhasil(data.status, data.pesan);
        },
        error: function(xhr, status, error) {
          var error = xhr.responseJSON;
          if ($.isEmptyObject(error) == false) {
            $.each(error.errors, function(key, value) {
              gagal(key, value);
            });
          }
        } // end error
      }); //end ajax
    } // end of else
    
  });
  // end add admin

  //mengecek password
  $('#password1').blur(function() {
    var password = $(this).val();
    var len = password.length;
    if (len > 0 && len < 8) {
      $(this).parent().find('.text-warning').text("");
      $(this).parent().find('.text-warning').text("password minimal 8 karakter");
      return apply_feedback_error(this);
    } else {
      if (len > 15) {
        $(this).parent().find('.text-warning').text("");
        $(this).parent().find('.text-warning').text("password maximal 15 karakter");
        return apply_feedback_error(this);
      }
    }
  });
  //mengecek konfirmasi password
  $('#password2').blur(function() {
    var pass = $("#password1").val();
    var conf = $(this).val();
    var len = conf.length;
    if (len > 0 && pass !== conf) {
      $(this).parent().find('.text-warning').text("");
      $(this).parent().find('.text-warning').text("Konfirmasi Password tidak sama dengan password");
      return apply_feedback_error(this);
    }
  });
</script>
@endsection