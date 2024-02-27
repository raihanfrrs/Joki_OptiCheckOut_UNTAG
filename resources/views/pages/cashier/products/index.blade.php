@extends('layouts.main')

@section('section-content')

<div class="container-xxl flex-grow-1 container-p-y">
    @if ($products->count())
    <div class="row" id="row-list-products">
        @foreach ($products as $product)
        <div class="col-md-3 col-sm-4">
            <div class="card mb-3">
                <img class="card-img-top" src="{{ $product->getFirstMediaUrl('product_images') }}" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }} <span style="float: right">@rupiah($product->price->price)</span></h5>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item ps-0">Category <span style="float: right">{{ $product->category->name }}</span></li>
                        <li class="list-group-item ps-0">Stock <span style="float: right">{{ $product->stock }}</span></li>
                    </ul>
                    <button class="btn {{ $product->temp_transaction()->exists() && auth()->user()->cashier->temp_transaction()->exists() ? 'btn-secondary' : 'btn-primary' }} w-100" id="button-add-to-cart" data-id="{{ $product->id }}" {{ $product->temp_transaction()->exists() && auth()->user()->cashier->temp_transaction()->exists() ? 'disabled' : '' }}><i class="ti ti-shopping-cart-plus me-2"></i> {{ $product->temp_transaction()->exists() && auth()->user()->cashier->temp_transaction()->exists() ? 'Already Added' : 'Add to Cart' }}</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="misc-wrapper mt-5">
        <h2 class="mb-1 mx-2 d-flex justify-content-center">No Products Available!</h2>
        <p class="mb-4 mx-2 d-flex justify-content-center">Apologies for the inconvenience, but the product is currently unavailable.</p>
        <div class="mt-4 d-flex justify-content-center">
          <img src="../../assets/img/illustrations/page-misc-under-maintenance.png" alt="page-misc-under-maintenance" width="550" class="img-fluid">
        </div>
    </div>
    @endif
</div>

@endsection