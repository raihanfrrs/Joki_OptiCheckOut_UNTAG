@extends('layouts.main')

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Keranjang /</span> Pembayaran</h4>
    <!-- Checkout Wizard -->
    <div id="wizard-checkout" class="bs-stepper wizard-icons wizard-icons-example mt-2">
      <div class="bs-stepper-content border-top">
        <form id="wizard-checkout-form" action="{{ route('cart.store') }}" method="POST">
          @csrf
          <!-- Cart -->
          <div id="checkout-cart" class="content active dstepper-block fv-plugins-bootstrap5 fv-plugins-framework">
            <div class="row">
              <!-- Cart left -->
              <div class="col-xl-8 mb-3 mb-xl-0">

                <!-- Shopping bag -->
                <h5>Tas Belanja Saya ({{ $carts->count() }} Produk)</h5>
                <ul class="list-group mb-3">
                    @foreach ($carts as $cart)
                      @if ($cart->product->stock > 0)
                        <li class="list-group-item p-4">
                          <div class="d-flex gap-3">
                          <div class="flex-shrink-0 d-flex align-items-center">
                              <img src="{{ $cart->product->getFirstMediaUrl('product_images') }}" alt="{{ $cart->product->name }}" class="w-px-100">
                          </div>
                          <div class="flex-grow-1">
                              <div class="row">
                              <div class="col-md-8">
                                  <p class="me-3">
                                      <a href="javascript:void(0)" class="text-body">{{ $cart->product->name }} - {{ $cart->product->category->name }}</a>
                                  </p>
                                  <div class="text-muted mb-4 d-flex flex-wrap">
                                    <span class="me-3">Jumlah:</span>
                                    <a href="javascript:void(0)" class="me-3">
                                      <input type="number" class="form-control form-control-sm w-px-75" value="{{ $cart->qty }}" min="1" max="{{ $cart->product->stock }}" id="input-product-cart-quantity" data-id="{{ $cart->product->id }}">
                                    </a>
                                  </div>
                                  <div class="text-muted mb-4 d-flex flex-wrap">
                                    <span class="me-3">Temperatur:</span>
                                    @foreach ($temperatures as $temperature)
                                      <a href="javascript:void(0)" class="me-3">
                                        <input type="radio" name="temperature_id_{{ $cart->id }}" value="{{ $temperature->id }}" class="form-check-input radio-product-cart-temperature" id="{{ $temperature->id }}_{{ $cart->id }}" data-id="{{ $cart->id }}" {{ $cart->temperature_id == $temperature->id ? 'checked' : '' }}>
                                        <label class="form-check-label text-capitalize" for="{{ $temperature->id }}_{{ $cart->id }}">{{ $temperature->name }}</label>
                                      </a>
                                    @endforeach
                                  </div>
                                  <div class="text-muted mb-4 d-flex flex-wrap">
                                    <span class="me-3">Ukuran:</span>
                                    @foreach ($sizes as $size)
                                      <a href="javascript:void(0)" class="me-3">
                                        <input type="radio" name="size_id_{{ $cart->id }}" value="{{ $size->id }}" class="form-check-input radio-product-cart-size" id="{{ $size->id }}_{{ $cart->id }}" data-id="{{ $cart->id }}" {{ $cart->size_id == $size->id ? 'checked' : '' }}>
                                        <label class="form-check-label text-capitalize" for="{{ $size->id }}_{{ $cart->id }}">{{ $size->name }}</label>
                                      </a>
                                    @endforeach
                                  </div>
                                  <div class="text-muted mb-4 d-flex flex-wrap">
                                    <span class="me-3">Topping:</span>
                                    @foreach ($toppings as $topping)
                                      <a href="javascript:void(0)" class="me-3">
                                        <input type="radio" name="topping_id_{{ $cart->id }}" value="{{ $topping->id }}" class="form-check-input radio-product-cart-topping" id="{{ $topping->id }}_{{ $cart->id }}" data-id="{{ $cart->id }}" {{ $cart->topping_id == $topping->id ? 'checked' : '' }}>
                                        <label class="form-check-label text-capitalize" for="{{ $topping->id }}_{{ $cart->id }}">{{ $topping->name }}</label>
                                      </a>
                                    @endforeach
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="text-md-end">
                                  <button type="button" class="btn-close btn-pinned" aria-label="Close" id="button-delete-shopping-cart-product" data-id="{{ $cart->product->id }}"></button>
                                  <div class="my-2 my-md-4 mb-md-5">
                                      <span class="text-primary" id="label-product-cart-subtotal-value-{{ $cart->product->id }}">@rupiah($cart->product->price->price)</span>
                                  </div>
                                  <a href="javascript:void(0)" class="btn btn-sm btn-label-{{ $cart->product->stock > 0 ? 'success' : 'danger' }} waves-effect">
                                      {{ $cart->product->stock > 0 ? 'Tersedia' : 'Habis' }}
                                  </a>
                                  </div>
                              </div>
                              </div>
                          </div>
                          </div>
                        </li>
                      @endif
                    @endforeach
                </ul>

                <div class="list-group">
                  <a href="{{ route('products.index', 'all') }}" class="list-group-item d-flex justify-content-between">
                    <span>Tambahkan lebih banyak produk</span>
                    <i class="ti ti-sm ti-chevron-right scaleX-n1-rtl"></i>
                  </a>
                </div>
              </div>

              <div class="col-xl-4">
                <div class="border rounded p-4 mb-3 pb-3">

                  <div id="checkout-cart-summary">
                    <h6>Rincian Harga</h6>
                    <dl class="row mb-0">
                      {{-- <dt class="col-6 fw-normal">Bag Total</dt>
                      <dd class="col-6 text-end">$1198.00</dd>
  
                      <dt class="col-sm-6 fw-normal">Coupon Discount</dt>
                      <dd class="col-sm-6 text-success text-end">-$98.00</dd> --}}
  
                      <dt class="col-6 fw-normal">Total Pembelian</dt>
                      <dd class="col-6 text-end">@rupiah($carts->sum('subtotal'))</dd>
  
                      {{-- <dt class="col-6 fw-normal">Delivery Charges</dt>
                      <dd class="col-6 text-end">
                        <s>$5.00</s> <span class="badge bg-label-success ms-1">Free</span>
                      </dd> --}}
                    </dl>
  
                    <hr class="mx-n4">
                    <dl class="row mb-0">
                      <dt class="col-6">Total</dt>
                      <dd class="col-6 fw-semibold text-end mb-0">@rupiah($carts->sum('subtotal'))</dd>
                    </dl>
                  </div>
                </div>
                @if ($carts->count() > 0)
                <div class="d-grid">
                  <button type="submit" class="btn btn-primary btn-next waves-effect waves-light">Lakukan Pemesanan</button>
                </div>
                @endif
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>
    <!--/ Checkout Wizard -->
</div>
@endsection