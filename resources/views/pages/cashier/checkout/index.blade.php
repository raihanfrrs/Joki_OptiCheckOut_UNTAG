@extends('layouts.main')

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Cart /</span> Checkout</h4>
    <!-- Checkout Wizard -->
    <div id="wizard-checkout" class="bs-stepper wizard-icons wizard-icons-example mt-2">
      <div class="bs-stepper-content border-top">
        <form id="wizard-checkout-form" onsubmit="return false">
          <!-- Cart -->
          <div id="checkout-cart" class="content active dstepper-block fv-plugins-bootstrap5 fv-plugins-framework">
            <div class="row">
              <!-- Cart left -->
              <div class="col-xl-8 mb-3 mb-xl-0">

                <!-- Shopping bag -->
                <h5>My Shopping Bag ({{ $carts->count() }} Items)</h5>
                <ul class="list-group mb-3">
                    @foreach ($carts as $cart)
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
                                {{-- <input type="number" class="form-control form-control-sm w-px-75" value="1" min="1" max="5"> --}}
                            </div>
                            <div class="col-md-4">
                                <div class="text-md-end">
                                <button type="button" class="btn-close btn-pinned" aria-label="Close"></button>
                                <div class="my-2 my-md-4 mb-md-5">
                                    <span class="text-primary" id="label-product-cart-subtotal-value-{{ $cart->product->id }}">@rupiah($cart->product->price->price)</span>
                                </div>
                                <a href="javascript:void(0)" class="btn btn-sm btn-label-{{ $cart->product->stock > 0 ? 'success' : 'danger' }} waves-effect">
                                    {{ $cart->product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                </a>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <!-- Wishlist -->
                <div class="list-group">
                  <a href="javascript:void(0)" class="list-group-item d-flex justify-content-between">
                    <span>Add more products from wishlist</span>
                    <i class="ti ti-sm ti-chevron-right scaleX-n1-rtl"></i>
                  </a>
                </div>
              </div>

              <!-- Cart right -->
              <div class="col-xl-4">
                <div class="border rounded p-4 mb-3 pb-3">
                  <!-- Offer -->
                  <h6>Offer</h6>
                  <div class="row g-3 mb-3">
                    <div class="col-8 col-xxl-8 col-xl-12">
                      <input type="text" class="form-control" placeholder="Enter Promo Code" aria-label="Enter Promo Code">
                    </div>
                    <div class="col-4 col-xxl-4 col-xl-12">
                      <div class="d-grid">
                        <button type="button" class="btn btn-label-primary waves-effect">Apply</button>
                      </div>
                    </div>
                  </div>

                  <!-- Gift wrap -->
                  <div class="bg-lighter rounded p-3">
                    <p class="fw-semibold mb-2">Buying gift for a loved one?</p>
                    <p class="mb-2">Gift wrap and personalized message on card, Only for $2.</p>
                    <a href="javascript:void(0)" class="fw-semibold">Add a gift wrap</a>
                  </div>
                  <hr class="mx-n4">

                  <!-- Price Details -->
                  <h6>Price Details</h6>
                  <dl class="row mb-0">
                    <dt class="col-6 fw-normal">Bag Total</dt>
                    <dd class="col-6 text-end">$1198.00</dd>

                    <dt class="col-sm-6 fw-normal">Coupon Discount</dt>
                    <dd class="col-sm-6 text-success text-end">-$98.00</dd>

                    <dt class="col-6 fw-normal">Order Total</dt>
                    <dd class="col-6 text-end">$1100.00</dd>

                    <dt class="col-6 fw-normal">Delivery Charges</dt>
                    <dd class="col-6 text-end">
                      <s>$5.00</s> <span class="badge bg-label-success ms-1">Free</span>
                    </dd>
                  </dl>

                  <hr class="mx-n4">
                  <dl class="row mb-0">
                    <dt class="col-6">Total</dt>
                    <dd class="col-6 fw-semibold text-end mb-0">$1100.00</dd>
                  </dl>
                </div>
                <div class="d-grid">
                  <button class="btn btn-primary btn-next waves-effect waves-light">Place Order</button>
                </div>
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>
    <!--/ Checkout Wizard -->
</div>
@endsection