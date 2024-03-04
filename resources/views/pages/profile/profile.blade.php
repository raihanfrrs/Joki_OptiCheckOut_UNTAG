<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5">
      <div class="card mb-4">
        <div class="card-body">
          <small class="card-text text-uppercase">Tentang</small>
          <ul class="list-unstyled mb-4 mt-3">
            <li class="d-flex align-items-center mb-3 text-capitalize">
              <i class="ti ti-user"></i><span class="fw-bold mx-2">Nama Lengkap:</span> <span>{{ $data->first_name . ' ' . $data->last_name }}</span>
            </li>
            <li class="d-flex align-items-center mb-3 text-capitalize">
              <i class="ti ti-{{ $data->gender == 'male' ? 'gender-male' : 'gender-femme' }}"></i><span class="fw-bold mx-2">Jenis Kelamin:</span> <span>{{ $data->gender }}</span>
            </li>
            <li class="d-flex align-items-center mb-3 text-capitalize">
              <i class="ti ti-check"></i><span class="fw-bold mx-2">Tempat, Tanggal Lahir:</span> <span>{{ $data->place_of_birth }}, {{ \Carbon\Carbon::parse($data->date_of_birth)->format('d/m/Y') }}</span>
            </li>
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-crown"></i><span class="fw-bold mx-2">Alamat:</span> <span>{{ $data->address }}</span>
            </li>
            @if (auth()->user()->level == 'cashier')
            <li class="d-flex align-items-center mb-3 text-capitalize">
              <i class="ti ti-flag"></i><span class="fw-bold mx-2">Status:</span> <span>{{ $data->status }}</span>
            </li>
            @endif
          </ul>
          <small class="card-text text-uppercase">Kontak</small>
          <ul class="list-unstyled mb-4 mt-3">
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-phone-call"></i><span class="fw-bold mx-2">Ponsel:</span>
              <span>{{ $data->phone }}</span>
            </li>
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-mail"></i><span class="fw-bold mx-2">Surel:</span>
              <span>{{ $data->email }}</span>
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
            @if (auth()->user()->level == 'admin')
            <li class="d-flex align-items-center">
              <i class="ti ti-users"></i><span class="fw-bold mx-2">Jumlah Tim:</span> <span>{{ $cashier->count() }}</span>
            </li>
            @elseif (auth()->user()->level == 'cashier')
            <li class="d-flex align-items-center">
              <i class="ti ti-subtask"></i><span class="fw-bold mx-2">Jumlah Transaksi:</span> <span>{{ auth()->user()->cashier->transaction->count() }}</span>
            </li>
            @endif
          </ul>
        </div>
      </div>
    </div>

    <div class="col-xl-8 col-lg-7 col-md-7">
      @if (auth()->user()->level == 'admin')
      <div class="card mb-4">
        <div class="card-header border-bottom">
          <h5 class="card-title mb-3">Aktifitas Terbaru</h5>
        </div>
        <div class="card-datatable table-responsive">
          <table class="table border-top" id="listAdminActivityTable">
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
      @elseif (auth()->user()->level == 'cashier')
      <div class="card mb-4">
        <div class="card-header border-bottom">
          <h5 class="card-title mb-3">Aktifitas Terbaru</h5>
        </div>
        <div class="card-datatable table-responsive">
          <table class="table border-top" id="listCashierActivityTable">
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
      @endif
    </div>
</div>