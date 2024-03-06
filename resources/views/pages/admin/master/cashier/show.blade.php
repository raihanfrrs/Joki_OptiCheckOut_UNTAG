@extends('layouts.main')

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Rincian /</span> Kasir</h4>

    <!-- Header -->
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="user-profile-header-banner">
            <img src="{{ asset('assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top">
          </div>
          <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
            <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                <img src="{{ $cashier->getFirstMediaUrl('cashier_images') }}" alt="user-avatar" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" id="uploadedAvatar">
            </div>
            <div class="flex-grow-1 mt-3 mt-sm-5">
              <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                <div class="user-profile-info">
                  <h4 class="text-capitalize">{{ $cashier->first_name . ' ' . $cashier->last_name }}</h4>
                  <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                    <li class="list-inline-item text-capitalize"><i class="ti ti-color-swatch"></i> {{ $cashier->user->level }}</li>
                    <li class="list-inline-item"><i class="ti ti-calendar"></i> Bergabung {{ \Carbon\Carbon::parse($cashier->created_at)->format('F Y') }}</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-pills flex-column flex-sm-row mb-4">
            <li class="nav-item">
              <a class="nav-link {{ request()->is('master/cashier/*') ? 'active' : '' }}" href="javascript:void(0)"><i class="ti ti-user-check ti-xs me-1"></i> Profil</a>
            </li>
          </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-5">
          <div class="card mb-4">
            <div class="card-body">
              <small class="card-text text-uppercase">Tentang</small>
              <ul class="list-unstyled mb-4 mt-3">
                <li class="d-flex align-items-center mb-3 text-capitalize">
                  <i class="ti ti-user"></i><span class="fw-bold mx-2">Nama Lengkap:</span> <span>{{ $cashier->first_name . ' ' . $cashier->last_name }}</span>
                </li>
                <li class="d-flex align-items-center mb-3 text-capitalize">
                  <i class="ti ti-{{ $cashier->gender == 'male' ? 'gender-male' : 'gender-femme' }}"></i><span class="fw-bold mx-2">Jenis Kelamin:</span> <span>{{ $cashier->gender }}</span>
                </li>
                <li class="d-flex align-items-center mb-3 text-capitalize">
                  <i class="ti ti-check"></i><span class="fw-bold mx-2">Tempat, Tanggal Lahir:</span> <span>{{ $cashier->place_of_birth }}, {{ \Carbon\Carbon::parse($cashier->date_of_birth)->format('d/m/Y') }}</span>
                </li>
                <li class="d-flex align-items-center mb-3">
                  <i class="ti ti-crown"></i><span class="fw-bold mx-2">Alamat:</span> <span>{{ $cashier->address }}</span>
                </li>
                <li class="d-flex align-items-center mb-3 text-capitalize">
                  <i class="ti ti-flag"></i><span class="fw-bold mx-2">Status:</span> <span>{{ $cashier->status }}</span>
                </li>
              </ul>
              <small class="card-text text-uppercase">Kontak</small>
              <ul class="list-unstyled mb-4 mt-3">
                <li class="d-flex align-items-center mb-3">
                  <i class="ti ti-phone-call"></i><span class="fw-bold mx-2">Ponsel:</span>
                  <span>{{ $cashier->phone }}</span>
                </li>
                <li class="d-flex align-items-center mb-3">
                  <i class="ti ti-mail"></i><span class="fw-bold mx-2">Surel:</span>
                  <span>{{ $cashier->email }}</span>
                </li>
              </ul>
            </div>
          </div>
    
          <div class="card mb-4">
            <div class="card-body">
              <p class="card-text text-uppercase">Tinjauan</p>
              <ul class="list-unstyled mb-0">
                <li class="d-flex align-items-center mb-3">
                  <i class="ti ti-social"></i><span class="fw-bold mx-2">Aktifitas Hari Ini:</span> <span>{{ $activity }}</span>
                </li>
                <li class="d-flex align-items-center">
                  <i class="ti ti-subtask"></i><span class="fw-bold mx-2">Jumlah Transaksi:</span> <span>{{ $cashier->transaction->count() }}</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
    
        <div class="col-xl-8 col-lg-7 col-md-7">
          <div class="card mb-4">
            <div class="card-header border-bottom">
              <h5 class="card-title mb-3">Aktifitas Terbaru</h5>
            </div>
            <div class="card-datatable table-responsive">
              <table class="table border-top" id="listCashierActivityDetailTable" data-id="{{ $cashier->id }}">
                <thead>
                  <tr>
                    <th></th>
                    <th class="text-center">No</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Deskripsi</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
    </div>

</div>
@endsection