<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TicketBus | @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview">
              <a href="{{ route('index') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-item {{ request()->is('managemen-jadwal') || request()->is('managemen-jadwal/tambah-jadwal') || request()->is('managemen-jadwal/riwayat-perjalanan') || request()->is('managemen-jadwal/dalam-perjalanan') ? 'has-treeview menu-open' : '' }}">
              <a href="#" class="nav-link {{ request()->is('managemen-jadwal') || request()->is('managemen-jadwal/tambah-jadwal') || request()->is('managemen-jadwal/tambah-jadwal') || request()->is('managemen-jadwal/riwayat-perjalanan') || request()->is('managemen-jadwal/dalam-perjalanan') ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>
                  Mangemen Jadwal
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('index.jadwal')}}" class="nav-link {{ request()->is('managemen-jadwal') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Data Jadwal
                    </p>
                  </a>
                  <a href="{{route('perjalanan.jadwal')}}" class="nav-link {{ request()->is('managemen-jadwal/dalam-perjalanan') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Dalam Perjalanan
                    </p>
                  </a>
                  <a href="{{route('create.jadwal')}}" class="nav-link {{ request()->is('managemen-jadwal/tambah-jadwal') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Tambah Jadwal
                    </p>
                  </a>
                  <a href="{{route('riwayat.jadwal')}}" class="nav-link {{ request()->is('managemen-jadwal/riwayat-perjalanan') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Riwayat Perjalanan
                    </p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item {{ request()->is('managemen-bus') || request()->is('managemen-bus/jalur-bus') || request()->is('managemen-bus/tambah-bus') ? 'has-treeview menu-open' : '' }}">
              <a href="#" class="nav-link {{ request()->is('managemen-bus') || request()->is('managemen-bus/jalur-bus') || request()->is('managemen-bus/tambah-bus') ? 'active' : '' }}">
                <i class="nav-icon fas fa-bus-alt"></i>
                <p>
                  Manajemen Bus
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('tambah.bus')}}" class="nav-link {{ request()->is('managemen-bus/tambah-bus') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Tambah Data Bus
                    </p>
                  </a>
                  <a href="{{route('pivot.bus')}}" class="nav-link {{ request()->is('managemen-bus/jalur-bus') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Tambah Jalur Bus
                    </p>
                  </a>
                  <a href="{{route('index.bus')}}" class="nav-link {{ request()->is('managemen-bus') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Bus</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="{{route('index.customer')}}" class="nav-link {{ request()->is('data-customer') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Customers
                </p>
              </a>
            </li>

            <li class="nav-item {{ request()->is('riwayat-transaksi') || request()->is('data-transaksi') ? 'has-treeview menu-open' : '' }}">
              <a href="#" class="nav-link {{ request()->is('riwayat-transaksi') || request()->is('data-transaksi') ? 'active' : '' }}">
                <i class="nav-icon fas fa-handshake"></i>
                <p>
                  Data Transaksi
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('index.transaksi')}}" class="nav-link {{ request()->is('data-transaksi') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Transaksi Customer</p>
                  </a>
                  <a href="{{route('riwayat.transaksi')}}" class="nav-link {{ request()->is('riwayat-transaksi') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Riwayat Transaksi</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="{{route('index.admin')}}" class="nav-link {{ request()->is('managemen-admin') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-cog"></i>
                <p>
                  Admin
                </p>
              </a>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2020 <a href="http://adminlte.io">Manajemen Ticket</a>.</strong>
      All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('admin/plugins/sparklines/sparkline.js') }}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <!-- Summernote -->
  <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
  <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

  @yield('js')
  <script type="text/javascript">
    function hapus() {
      $(document).on('click', "#del_data", function() {
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

    function status() {
      $(document).on('click', "#status_perjalanan", function() {
        Swal.fire({
          title: 'Anda Yakin ?',
          text: "Bus yang anda pilih akan di berangkatkan!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Lanjutkan!',
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

    function berhasil(status, pesan) {
      if (status == 'success') {
        Swal.fire({
          type: status,
          title: pesan,
          showConfirmButton: true,
          button: "Ok"
        }).then(function() {
          location.reload();
        })
      } else {
        Swal.fire({
          type: status,
          title: pesan,
          showConfirmButton: true,
          button: "Ok"
        })
      }
    }

    function gagal(key, pesan) {
      Swal.fire({
        type: 'error',
        title: key + ' : ' + pesan,
        showConfirmButton: true,
        button: "Ok"
      })
    }
  </script>
</body>

</html>