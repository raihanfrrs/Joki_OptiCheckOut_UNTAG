@extends('layouts.main')

@section('title')
  Master - Cashier - Edit
@endsection

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Pengguna /</span> Ubah Kasir
    </h4>

    <div id="wizard-property-listing" class="bs-stepper vertical mt-2 linear">
      <div class="bs-stepper-header" style="display: inline">
        <div class="step active" data-target="#personal-details">
          <button type="button" class="step-trigger" aria-selected="true">
            <span class="bs-stepper-circle"><i class="ti ti-home ti-sm"></i></span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Rincian Pengguna</span>
              <span class="bs-stepper-subtitle">Tentang Kasir</span>
            </span>
          </button>
        </div>
        <div class="line"></div>
        <div class="step" data-target="#account-details">
          <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
            <span class="bs-stepper-circle"><i class="ti ti-map-pin ti-sm"></i></span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Rincian Akun</span>
              <span class="bs-stepper-subtitle">Buat Akun</span>
            </span>
          </button>
        </div>
      </div>

      <div class="bs-stepper-content">
        <form id="wizard-property-listing-form" action="{{ route('master.cashier.update', $cashier->id) }}" onsubmit="return false" enctype="multipart/form-data" method="POST" class="form-submit-cashier">
            @csrf
            @method('PATCH')
            <div id="personal-details" class="content active dstepper-block fv-plugins-bootstrap5 fv-plugins-framework">
                <div class="row g-3">
                    <div class="col-sm-6 fv-plugins-icon-container">
                        <label class="form-label" for="first_name">Nama Depan</label>
                        <input type="text" id="first_name" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="First Name" value="{{ old('first_name', $cashier->first_name) }}">
                        @error('first_name')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 fv-plugins-icon-container">
                        <label class="form-label" for="last_name">Nama Belakang</label>
                        <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name" value="{{ old('last_name', $cashier->last_name) }}">
                        @error('last_name')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 fv-plugins-icon-container">
                        <label class="form-label" for="email">Alamat Surel</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email', $cashier->email) }}">
                        @error('email')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 fv-plugins-icon-container">
                        <label class="form-label" for="phone">Ponsel</label>
                        <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone" value="{{ old('phone', $cashier->phone) }}">
                        @error('phone')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 fv-plugins-icon-container">
                        <label class="form-label" for="pob">Tempat Lahir</label>
                        <input type="text" id="pob" name="pob" class="form-control @error('pob') is-invalid @enderror" placeholder="Place of Birth" value="{{ old('pob', $cashier->pob) }}">
                        @error('pob')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 fv-plugins-icon-container">
                        <label class="form-label" for="dob">Tgl. Lahir</label>
                        <input type="date" id="dob" name="dob" class="form-control @error('dob') is-invalid @enderror" placeholder="Date of Birth" value="{{ old('dob', $cashier->dob) }}">
                        @error('dob')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 fv-plugins-icon-container">
                        <label class="form-label d-block" for="address">Alamat</label>
                        <textarea name="address" id="address" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror" placeholder="Address">{{ old('address', $cashier->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 fv-plugins-icon-container">
                        <label class="form-label d-block" for="age">Jenis Kelamin</label>
                        <div class="form-check form-check-inline mb-2">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ old('gender', $cashier->gender) == 'male' ? 'checked' : '' }}>
                            <label class="form-check-label" for="male">Pria</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ old('gender', $cashier->gender) == 'female' ? 'checked' : '' }}>
                            <label class="form-check-label" for="female">Wanita</label>
                        </div>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-12 fv-plugins-icon-container">
                        <label class="form-label d-block" for="image">Foto Kasir</label>
                        <input type="file" name="cashier_image_update" id="image" class="form-control @error('cashier_image') is-invalid @enderror" onchange="previewImage()" accept="image/*">
                        <img class="img-fluid mt-3 img-preview w-25" src="{{ $cashier->getFirstMediaUrl('cashier_images') }}">
                        @error('cashier_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 d-flex justify-content-between mt-4">
                        <button class="btn btn-label-secondary btn-prev waves-effect" disabled="">
                            <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                        </button>
                        <button class="btn btn-primary btn-next waves-effect waves-light">
                            <span class="align-middle d-sm-inline-block d-none me-sm-1">Selanjutnya</span>
                            <i class="ti ti-arrow-right ti-xs"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div id="account-details" class="content fv-plugins-bootstrap5 fv-plugins-framework">
                <div class="row g-3">
                    <div class="col-sm-4 fv-plugins-icon-container">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" value="{{ old('username', $cashier->user->username) }}">
                        @error('username')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-4 fv-plugins-icon-container">
                        <label class="form-label" for="password">Kata Sandi</label>
                        <input type="password" id="password" name="password_update" class="form-control @error('password_update') is-invalid @enderror" placeholder="Password">
                        @error('password_update')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-4 fv-plugins-icon-container">
                        <label class="form-label" for="confirm_password">Konfirmasi Kata Sandi</label>
                        <input type="password" id="confirm_password" name="confirm_password_update" class="form-control @error('confirm_password_update') is-invalid @enderror" placeholder="Password Confirmation">
                        @error('confirm_password_update')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 d-flex justify-content-between mt-4">
                        <button class="btn btn-label-secondary btn-prev waves-effect">
                            <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                        </button>
                        <button class="btn btn-success btn-submit btn-next waves-effect waves-light">
                            <span class="align-middle d-sm-inline-block d-none me-sm-1">Kirim</span><i class="ti ti-check ti-xs"></i>
                        </button>
                    </div>
                </div>
            </div>

        </form>
      </div>
    </div>

</div>
@endsection