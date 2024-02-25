@extends('layouts.main')

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">User /</span> Add Cashier
    </h4>

    <div id="wizard-property-listing" class="bs-stepper vertical mt-2 linear">
      <div class="bs-stepper-header" style="display: inline">
        <div class="step active" data-target="#personal-details">
          <button type="button" class="step-trigger" aria-selected="true">
            <span class="bs-stepper-circle"><i class="ti ti-home ti-sm"></i></span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Personal Details</span>
              <span class="bs-stepper-subtitle">About Cashier</span>
            </span>
          </button>
        </div>
        <div class="line"></div>
        <div class="step" data-target="#account-details">
          <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
            <span class="bs-stepper-circle"><i class="ti ti-map-pin ti-sm"></i></span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Account Details</span>
              <span class="bs-stepper-subtitle">Create Account</span>
            </span>
          </button>
        </div>
      </div>

      <div class="bs-stepper-content">
        <form id="wizard-property-listing-form" action="{{ route('master.cashier.store') }}" onsubmit="return false" enctype="multipart/form-data" method="POST" class="form-submit-cashier">
            @csrf
            <div id="personal-details" class="content active dstepper-block fv-plugins-bootstrap5 fv-plugins-framework">
                <div class="row g-3">
                    <div class="col-sm-6 fv-plugins-icon-container">
                        <label class="form-label" for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="First Name" value="{{ old('first_name') }}">
                        @error('first_name')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 fv-plugins-icon-container">
                        <label class="form-label" for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name" value="{{ old('last_name') }}">
                        @error('last_name')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 fv-plugins-icon-container">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 fv-plugins-icon-container">
                        <label class="form-label" for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 fv-plugins-icon-container">
                        <label class="form-label" for="pob">Place of Birth</label>
                        <input type="text" id="pob" name="pob" class="form-control @error('pob') is-invalid @enderror" placeholder="Place of Birth" value="{{ old('pob') }}">
                        @error('pob')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 fv-plugins-icon-container">
                        <label class="form-label" for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" class="form-control @error('dob') is-invalid @enderror" placeholder="Date of Birth" value="{{ old('dob') }}">
                        @error('dob')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 fv-plugins-icon-container">
                        <label class="form-label d-block" for="address">Address</label>
                        <textarea name="address" id="address" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror" placeholder="Address">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 fv-plugins-icon-container">
                        <label class="form-label d-block" for="age">Gender</label>
                        <div class="form-check form-check-inline mb-2">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-12 fv-plugins-icon-container">
                        <label class="form-label d-block" for="image">Cashier Image</label>
                        <input type="file" name="cashier_image" id="image" class="form-control @error('cashier_image') is-invalid @enderror" onchange="previewImage()" accept="image/*">
                        <img class="img-fluid mt-3 img-preview w-25">
                        @error('cashier_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 d-flex justify-content-between mt-4">
                        <button class="btn btn-label-secondary btn-prev waves-effect" disabled="">
                            <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        <button class="btn btn-primary btn-next waves-effect waves-light">
                            <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                            <i class="ti ti-arrow-right ti-xs"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div id="account-details" class="content fv-plugins-bootstrap5 fv-plugins-framework">
                <div class="row g-3">
                    <div class="col-sm-4 fv-plugins-icon-container">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" value="{{ old('username') }}">
                        @error('username')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-4 fv-plugins-icon-container">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}">
                        @error('password')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-4 fv-plugins-icon-container">
                        <label class="form-label" for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Password Confirmation" value="{{ old('confirm_password') }}">
                        @error('confirm_password')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 d-flex justify-content-between mt-4">
                        <button class="btn btn-label-secondary btn-prev waves-effect">
                            <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        <button class="btn btn-success btn-submit btn-next waves-effect waves-light">
                            <span class="align-middle d-sm-inline-block d-none me-sm-1">Submit</span><i class="ti ti-check ti-xs"></i>
                        </button>
                    </div>
                </div>
            </div>

        </form>
      </div>
    </div>

</div>
@endsection