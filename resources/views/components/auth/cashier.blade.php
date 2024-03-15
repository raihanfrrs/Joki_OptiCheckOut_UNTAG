@extends('layouts.main')

@section('title')
  Sign In - Cashier
@endsection

@section('section-authentication')
<div class="authentication-wrapper authentication-cover authentication-bg">
  <div class="authentication-inner row">

    <div class="d-none d-lg-flex col-lg-7 p-0">
      <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
        <img src="{{ asset('assets/img/illustrations/auth-login-illustration-light.png') }}" alt="auth-login-cover" class="img-fluid my-5 auth-illustration" data-app-light-img="illustrations/auth-login-illustration-light.png" data-app-dark-img="illustrations/auth-login-illustration-dark.png">

        <img src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}" alt="auth-login-cover" class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png">
      </div>
    </div>

    <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
      <div class="w-px-400 mx-auto">
        <h3 class="mb-1 fw-bold">Selamat Datang Kembali!</h3>
        <p class="mb-4">Silakan masuk ke akun Anda dan mulailah petualangan.</p>
    
        <form id="formAuthentication" class="mb-3" action="{{ route('login.store', 'cashier') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input
                    type="text"
                    name="username"
                    class="form-control"
                    id="username"
                    placeholder="Username"
                    autofocus />
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 form-password-toggle">
                <div class="input-group input-group-merge">
                    <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                </div>
            </div>
            <button class="btn btn-primary d-grid w-100">Masuk</button>
        </form>
      </div>
    </div>
    
  </div>
</div>
@endsection