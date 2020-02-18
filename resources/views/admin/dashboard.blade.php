@extends('layouts.template')

@section('title')
Dashboard
@endsection
@section('content')
<!-- Content Header (Page header) -->
<style>
  .col-md-6 .small-box {
    height: 170px !important;
    cursor: pointer;
    transition: 1s;
  }

  .icon i {
    font-size: 100px !important;
  }

  .col-md-6 .small-box:hover .icon i {
    font-size: 120px !important;
  }

  .col-md-6 .small-box:hover {
    position: relative;
    bottom: 10px;
    box-shadow: 0 15px 15px #adacad;
    -webkit-box-shadow: 0 15px 15px #adacad;
    -moz-box-shadow: 0 15px 15px #adacad;
    transition: 1s;
  }

  .bg-custom1 {
    background-color: #f53b66;
  }

  .bg-custom2 {
    background-color: #3b9ef5;
  }

  .bg-custom3 {
    background-color: #b73bf5;
  }

  .small-box .inner h3 {
    margin-top: 70px !important;
  }

  .small-box .inner h3,
  .small-box .inner p {
    color: #fff;
  }

  .bg-custom-1,
  .bg-custom-2,
  .bg-custom-3 {
    color: #fff;
  }

  .bg-custom-1 {
    background-color: #4a47ff;
  }

  .bg-custom-2 {
    background-color: #ff6947;
  }

  .bg-custom-3 {
    background-color: #ff47ac;
  }
</style>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark"><img src="{{ asset('bintangprima.png') }}" alt="Logo Bintang Prima" width="250px"></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content mt-4">
  <div class="container-fluid">
    <div class="row card-box">
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-6">
            <!-- small box -->
            <a href="#">
              <div class="small-box bg-custom1">
                <div class="inner">
                  <div class="container">
                    <h3>{{$transaksi}}</h3>
                    <p>User yang bertransaksi</p>
                  </div>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-6">
            <!-- small box -->
            <a href="#">
              <div class="small-box bg-custom3">
                <div class="inner">
                  <div class="container">
                    <h3>{{$jadwal}}</h3>
                    <p>Jadwal bus yang tersedia</p>
                  </div>
                </div>
                <div class="icon">
                  <i class="fas fa-bus-alt"></i>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <!-- Info Boxes Style 2 -->
        @foreach($tipe as $tipes)
        <div class="info-box">
          <span class="info-box-icon bg-custom-1 elevation-1"><i class="fas fa-cog"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Jumlah Bus {{$tipes->nama}}</span>
            <span class="info-box-number">
              {{$tipes->jml}}
              <small>Unit</small>
            </span>
          </div>
        </div>
        @endforeach

      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection