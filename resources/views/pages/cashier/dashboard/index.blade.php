@extends('layouts.main')

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-xl-4 mb-4 col-lg-5 col-12">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-7">
            <div class="card-body text-nowrap">
              <h5 class="card-title mb-0">Selamat {{ auth()->user()->cashier()->withTrashed()->first()->first_name }}! 🎉</h5>
              <p class="mb-2">Penjualan terbaik bulan ini</p>
              <h4 class="text-primary mb-1">@rupiah($total_sales_monthly->sum('subtotal'))</h4>
            </div>
          </div>
          <div class="col-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img src="{{ asset('assets/img/illustrations/card-advance-sale.png') }}" height="140">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-8 mb-4 col-lg-7 col-12">
      <div class="card h-100">
        <div class="card-header">
          <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title mb-0">Statistik</h5>
            <small class="text-muted">Diperbarui setiap 1 bulan</small>
          </div>
        </div>
        <div class="card-body">
          <div class="row gy-3">
            <div class="col-md-4 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-success me-3 p-2">
                  <i class="ti ti-currency-dollar ti-sm"></i>
                </div>
                <div class="card-info">
                  <h5 class="mb-0">@rupiah($total_sales_monthly->sum('subtotal'))</h5>
                  <small>Pendapatan</small>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-danger me-3 p-2">
                  <i class="ti ti-shopping-cart ti-sm"></i>
                </div>
                <div class="card-info">
                  <h5 class="mb-0">{{ $total_product->sum('qty') }}</h5>
                  <small>Produk Terjual</small>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-warning me-3 p-2">
                  <i class="ti ti-clipboard-check ti-sm"></i>
                </div>
                <div class="card-info">
                  <h5 class="mb-0">{{ $total_invoice }}</h5>
                  <small>Faktur</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection