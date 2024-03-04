@extends('layouts.main')

@section('section-error')
<div class="container-xxl container-p-y">
    <div class="misc-wrapper">
      <h2 class="mb-1 mx-2">Anda tidak diotorisasi!</h2>
      <p class="mb-4 mx-2">
        Anda tidak memiliki izin untuk melihat halaman ini menggunakan kredensial yang telah Anda berikan saat login..<br>
      </p>
      <a href="/" class="btn btn-primary mb-4 waves-effect waves-light">Kembali</a>
      <div class="mt-4">
        <img src="{{ asset('assets/img/illustrations/page-misc-you-are-not-authorized.png') }}" alt="page-misc-not-authorized" width="170" class="img-fluid">
      </div>
    </div>
</div>
@endsection