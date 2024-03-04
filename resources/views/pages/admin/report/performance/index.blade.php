@extends('layouts.main')

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">Laporan Performa</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listPerformanceReportAdminTable">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Kasir</th>
              <th class="text-center">Transaksi</th>
              <th class="text-center">Produk Terjual</th>
              <th class="text-center">Pendapatan</th>
              <th class="text-center"></th>
            </tr>
          </thead>
        </table>
      </div>

    </div>
</div>
@endsection