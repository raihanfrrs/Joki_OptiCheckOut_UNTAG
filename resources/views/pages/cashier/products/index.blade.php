@extends('layouts.main')

@section('section-content')

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="{{ $products->count() ? 'nav-align-left' : '' }} mb-4">
        <ul class="nav nav-pills me-3" role="tablist">
            @foreach ($categories as $category)
            <li class="nav-item mb-3" role="presentation">
                <a href="{{ route('products.index', $category->id) }}" class="nav-link {{ $category->id == $product_category ? 'active' : '' }}">
                    {{ $category->name }}
                </a>
            </li>
            @endforeach
        </ul>

        <div class="tab-content overflow-auto" style="max-height: 50rem">
          <div class="tab-pane fade show active" id="navs-pills-left-home" role="tabpanel">
            <p class="mb-0">
                @if ($products->count())
                <div class="row" id="row-list-products">
                    @foreach ($products as $product)
                        @if ($product->stock > 0)
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="card mb-3">
                                    <img class="card-img-top" src="{{ $product->getFirstMediaUrl('product_images') }}" alt="{{ $product->name }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }} <span style="float: right">@rupiah($product->price->price)</span></h5>
                                        <ul class="list-group list-group-flush mb-3">
                                            <li class="list-group-item ps-0">Kategori <span style="float: right">{{ $product->category->name }}</span></li>
                                            <li class="list-group-item ps-0">Stok <span style="float: right">{{ $product->stock }}</span></li>
                                        </ul>
                                        <button class="btn {{ $product->temp_transaction()->exists() && auth()->user()->cashier->temp_transaction()->exists() ? 'btn-secondary' : 'btn-primary' }} w-100" id="button-add-to-cart" data-id="{{ $product->id }}" {{ $product->temp_transaction()->exists() && auth()->user()->cashier->temp_transaction()->exists() ? 'disabled' : '' }}><i class="ti ti-shopping-cart-plus me-2"></i> {{ $product->temp_transaction()->exists() && auth()->user()->cashier->temp_transaction()->exists() ? 'Sudah Ditambahkan' : 'Tambahkan ke Keranjang' }}</button>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="card mb-3">
                                    <img class="card-img-top" src="{{ $product->getFirstMediaUrl('product_images') }}" alt="{{ $product->name }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }} <span style="float: right">@rupiah($product->price->price)</span></h5>
                                        <ul class="list-group list-group-flush mb-3">
                                            <li class="list-group-item ps-0">Kategori <span style="float: right">{{ $product->category->name }}</span></li>
                                            <li class="list-group-item ps-0">Stok <span style="float: right">{{ $product->stock }}</span></li>
                                        </ul>
                                        <button class="btn btn-secondary w-100" disabled><i class="ti ti-shopping-cart-plus me-2"></i> Stok Habis</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                @else
                <div class="misc-wrapper mt-5">
                    <h2 class="mb-1 mx-2 d-flex justify-content-center">Tidak Ada Produk Tersedia!</h2>
                    <p class="mb-4 mx-2 d-flex justify-content-center">Mohon maaf atas ketidaknyamanannya, namun produk saat ini tidak tersedia.</p>
                    <div class="mt-4 d-flex justify-content-center">
                      <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}" alt="page-misc-under-maintenance" width="550" class="img-fluid">
                    </div>
                </div>
                @endif
            </p>
          </div>
        </div>
    </div>
</div>

@endsection