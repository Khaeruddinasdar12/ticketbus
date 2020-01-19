@extends('layouts.template')

@section('title')
Manajemen Bus
@endsection

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Managemen Bus</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Managemen Bus</a></li>
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
              <h3 class="card-title">Manage Bus</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>

            <!-- FORM TAMBAH BUS -->
            
            <div class="card-body">
              <form action="" method="">
              <div class="form-group">
                <label >Nama Bus</label>
                <input type="text" name="nama" class="form-control">
              </div>
              <div class="form-group">
                <label >Deskripsi Bus</label>
                <textarea name="deskripsi" class="form-control" rows="4"></textarea>
              </div>
              <div class="form-group">
                <label >Tipe Bus</label>
                <select class="form-control custom-select">
                  <option selected disabled>Pilih tipe</option>
                  <option>Sleeper</option>
                  <option>Seatbelt</option>
                  <option>Comfortable</option>
                </select>
              </div>
              <div class="form-group">
                <label >Jumlah Kursi</label>
                <input type="number" name="jumlah_kursi" class="form-control">
              </div>
              <div class="form-group">
                <label>Harga Rp. Per kursi</label>
                <input type="text" name="harga" class="form-control">
              </div>
              <div class="form-group">
		          <a href="#" class="btn btn-secondary">Cancel</a>
		          <button type="reset" class="btn btn-secondary float-left"><i class="nav-icon fas fa-sync-alt"></i> Reset</button>
		          <button type="submit" class="btn btn-success float-right"><i class="nav-icon fas fa-plus"></i> Tambah</button>
              </form>
		        </div>
            </div>
            
            <!-- END FORM TAMBAH BUS -->


		        
		   
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Tambah Tipe Bus</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>

            <!-- FORM TAMBAH TIPE -->
            
            <div class="card-body">
              <form action="" method="">
              <div class="form-group">
                <label for="inputEstimatedBudget">Nama Tipe : </label>
                <input type="text" name="nama" class="form-control">
              </div>

              <div class="form-group">
		          <!-- <a href="#" class="btn btn-secondary">Cancel</a> -->
		          <button type="reset" class="btn btn-secondary float-left"><i class="nav-icon fas fa-sync-alt"></i> Reset</button>
		          <button type="submit" class="btn btn-success float-right"><i class="nav-icon fas fa-plus"></i> Tambah</button>
              </form>
		        </div>
            </div>
            <!-- END FORM TAMBAH TIPE -->

            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </section>
@endsection