<form action="{{ route('settings.profile.update') }}" id="formAccountSettings" method="POST" class="fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                @if (auth()->user()->level == 'admin')
                    @if (auth()->user()->admin->getFirstMediaUrl('admin_images'))
                        <img src="{{ auth()->user()->admin->getFirstMediaUrl('admin_images') }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded img-preview" id="uploadedAvatar">
                    @else
                        <img src="{{ asset('assets/img/avatars/14.png') }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded img-preview" id="uploadedAvatar">
                    @endif
                @else
                    @if (auth()->user()->cashier->getFirstMediaUrl('cashier_images'))
                        <img src="{{ auth()->user()->cashier->getFirstMediaUrl('cashier_images') }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded img-preview" id="uploadedAvatar">
                    @else
                        <img src="{{ asset('assets/img/avatars/14.png') }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded img-preview" id="uploadedAvatar">
                    @endif
                @endif
                <div class="button-wrapper">
                    <label for="image" class="btn btn-primary me-2 mb-3 waves-effect waves-light" tabindex="0">
                        <span class="d-none d-sm-block">Upload new photo</span>
                        <i class="ti ti-upload d-block d-sm-none"></i>
                        <input type="file" id="image" name="{{ auth()->user()->level == 'admin' ? 'admin_image' : 'cashier_image' }}" class="account-file-input" hidden="" accept="image/png, image/jpeg" onchange="previewImage()">
                    </label>
                    @error(auth()->user()->level == 'admin' ? 'admin_image' : 'cashier_image')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <hr class="my-0">
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-md-6 fv-plugins-icon-container">
                    <label for="first_name" class="form-label">First Name</label>
                    <input class="form-control @error('first_name') is-invalid @enderror" type="text" id="first_name" name="first_name" value="{{ old('first_name', $data->first_name) }}" placeholder="First Name" autofocus="" required>
                    @error('first_name')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 col-md-6 fv-plugins-icon-container">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input class="form-control @error('first_name') is-invalid @enderror" type="text" name="last_name" id="last_name" value="{{ old('last_name', $data->last_name) }}" placeholder="Last Name" required>
                    @error('last_name')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email', $data->email) }}" placeholder="Email" required>
                    @error('email')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $data->phone) }}" placeholder="Phone" required>
                    @error('phone')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label for="pob" class="form-label">Place of Birth</label>
                    <input type="text" class="form-control" id="pob" name="pob" value="{{ old('pob', $data->pob) }}" placeholder="Place of Birth">
                    @error('pob')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob', $data->dob) }}" required>
                    @error('dob')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3 col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" class="form-control" cols="5" rows="10" placeholder="Address" required>{{ old('address', $data->address) }}</textarea>
                    @error('address')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label d-block" for="age">Gender</label>
                    <div class="form-check form-check-inline mb-2">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ old('gender', $data->gender) == 'male' ? 'checked' : '' }}>
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ old('gender', $data->gender) == 'female' ? 'checked' : '' }}>
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Save changes</button>
                <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
            </div>
        </div>
    </div>
</form>


  @if (auth()->user()->level == 'cashier')
     <div class="card">
      <h5 class="card-header">Non-active Account</h5>
      <div class="card-body">
        <div class="mb-3 col-12 mb-0">
          <div class="alert alert-warning">
            <h5 class="alert-heading mb-1">Are you sure you want to nonactive your account?</h5>
            <p class="mb-0">Once you nonactive your account, there is no going back. Please be certain.</p>
          </div>
        </div>
        <form id="formAccountDeactivation" onsubmit="return false" class="fv-plugins-bootstrap5 fv-plugins-framework form-update-deactivate-profile-settings" novalidate="novalidate">
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation">
                <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
                <div class="fv-plugins-message-container invalid-feedback"></div>
            </div>
          <button type="submit" class="btn btn-danger deactivate-account waves-effect waves-light">Deactivate Account</button>
        </form>
      </div>
    </div>
  @endif