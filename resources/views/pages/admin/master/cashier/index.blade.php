@extends('layouts.main')

@section('title')
  Master - Cashier
@endsection

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">Daftar Kasir</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listMasterCashierTable">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Kasir</th>
              <th class="text-center">Alamat Surel</th>
              <th class="text-center">Ponsel</th>
              <th class="text-center">Tempat & Tanggal Lahir</th>
              <th class="text-center">Jenis Kelamin</th>
              <th class="text-center">Alamat</th>
              <th class="text-center">Terdaftar Pada</th>
              <th class="text-center">Status</th>
              <th class="text-center"></th>
            </tr>
          </thead>
        </table>
      </div>

    </div>
</div>
@endsection