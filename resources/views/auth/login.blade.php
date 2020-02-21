@extends('layouts.app')

@section('content')
<style>
  body {
    background-color: #dae6f0 !important;
  }

  input {
    border-radius: 50px !important;
    width: 400px !important;
    padding-left: 25px !important;
    height: 50px !important;
    position: relative;
  }

  i {
    float: right;
    right: 30px;
    position: relative;
    margin-top: -34px;
    color: #359ce6 !important;
  }

  img {
    padding-left: 90px !important;
  }

  h5 {
    color: #359ce6 !important;
  }

  .card {
    margin-top: 70px;
    padding-top: 100px;
    padding-bottom: 100px;
    background-color: #fff;
    border-radius: 10px !important;
    box-shadow: 0 20px 30px #adacad;
    -webkit-box-shadow: 0 20px 30px #adacad;
    -moz-box-shadow: 0 20px 30px #adacad;
  }

  .login {
    border-radius: 50px !important;
    width: 400px !important;
    height: 50px !important;
  }

  .input-login {
    padding-right: 10px !important;
  }

  .padding-1 {
    padding-top: 60px !important;
  }

  .padding-2 {
    padding-left: 70px !important;
  }
</style>
<div class="container">
  <div class="card">
    <div class="row">
      <div class="col-md-5 padding-1">
        <img src="{{ asset('bintangprimadashboard.png') }}" alt="Logo Bintang Prima" width="500px;">
      </div>
      <div class="col-md-5 offset-1 padding-2" style="border-left: 1px solid #d9d1d0;">
        <h5 class="mb-5">Login Admin</h5>
        <form method="POST" action="{{ route('login') }}">
          @csrf

          <div class="form-group row mb-4">

            <div class="col-md-12">
              <input id="email" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="username">
              <i class="fas fa-user"></i>

              @error('username')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="form-group row mb-4">
            <div class="col-md-12">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="password">
              <i class="fas fa-lock"></i>

              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="form-group row mb-0">
            <div class="col-md-6">
              <button type="submit" class="btn btn-primary login">
                {{ __('LOGIN') }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection