@extends('layouts.main')

@section('title')
  Trash - {{ request()->is('trash/cashier') ? 'Cashier' : (request()->is('trash/product') ? 'Product' : 'Category') }}
@endsection

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sampah /</span> {{ request()->is('trash/cashier') ? 'Kasir' : (request()->is('trash/product') ? 'Produk' : 'Kategori') }}</h4>

    <div class="row">
        <div class="col-xl-12">
            <div class="nav-align-top mb-4">
              <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                <li class="nav-item" role="presentation">
                  <a href="{{ route('trash.cashier.index') }}" class="nav-link {{ request()->is('trash/cashier') ? 'active' : '' }}">
                    <i class="tf-icons ti ti-home ti-users me-1"></i> Kasir
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger ms-1" id="label-total-cashier-trash-count"></span>
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a href="{{ route('trash.product.index') }}" class="nav-link {{ request()->is('trash/product') ? 'active' : '' }}">
                    <i class="tf-icons ti ti-user ti-soup me-1"></i> Produk
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger ms-1" id="label-total-product-trash-count"></span>
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a href="{{ route('trash.category.index') }}" class="nav-link {{ request()->is('trash/category') ? 'active' : '' }}">
                    <i class="tf-icons ti ti-box ti-xs me-1"></i> Kategori
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger ms-1" id="label-total-category-trash-count"></span>
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                @if (request()->is('trash/cashier'))
                    @include('pages.admin.trash.cashier.index')
                @elseif (request()->is('trash/product'))
                    @include('pages.admin.trash.product.index')
                @elseif (request()->is('trash/category'))
                    @include('pages.admin.trash.category.index')
                @endif
              </div>
            </div>
        </div>
    </div>
</div>
@endsection