<div class="card mb-4">
    <h5 class="card-header">Ubah Akun</h5>
    <div class="card-body">
      <form action="{{ route('settings.account.update') }}" id="formAccountSettings" method="POST" onsubmit="return false" class="fv-plugins-bootstrap5 fv-plugins-framework form-update-account-settings" novalidate="novalidate">
        @csrf
        @method('PATCH')
        <div class="row">
          <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
            <label class="form-label" for="username">Username</label>
            <input class="form-control" type="text" name="username" id="username" placeholder="Username" value="{{ old('username', $data->username) }}">
            @error('username')
              <div class="fv-plugins-message-container invalid-feedback"></div>
            @enderror
          </div>
        </div>

        <div class="row">
          <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
            <label class="form-label" for="newPassword">Kata Sandi Baru</label>
            <div class="input-group input-group-merge has-validation">
              <input class="form-control" type="password" id="newPassword" name="password" placeholder="············">
              <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
            </div>
            @error('password')
              <div class="fv-plugins-message-container invalid-feedback"></div>
            @enderror
          </div>

          <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
            <label class="form-label" for="confirmPassword">Ulangi Kata Sandi</label>
            <div class="input-group input-group-merge has-validation">
              <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" placeholder="············">
              <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
            </div>
            @error('confirmPassword')
              <div class="fv-plugins-message-container invalid-feedback"></div>
            @enderror
          </div>
          
          <div class="col-12 mb-4">
            <h6>Persyaratan Kata Sandi:</h6>
            <ul class="ps-3 mb-0">
              <li class="mb-1">Minimal 8 karakter panjangnya - semakin panjang, semakin baik.</li>
              <li class="mb-1">Paling tidak satu karakter huruf kecil.</li>
              <li>Paling tidak satu angka, simbol, atau karakter spasi.</li>
            </ul>
          </div>
          <div>
            <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Simpan Perubahan</button>
            <button type="reset" class="btn btn-label-secondary waves-effect">Batal</button>
          </div>
        </div>
      </form>
    </div>
</div>