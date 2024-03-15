@extends('layouts.main')

@section('title')
  Reporting - Monthly Sales
@endsection

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">Laporan Penjualan Bulanan</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listMonthlySalesReportAdminTable">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Bulan Transaksi</th>
              <th class="text-center">Jumlah</th>
              <th class="text-center">Total</th>
              <th class="text-center"></th>
            </tr>
          </thead>
        </table>
      </div>

    </div>
</div>
@endsection