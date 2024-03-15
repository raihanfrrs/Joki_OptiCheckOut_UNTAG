@extends('layouts.main')

@section('title')
  Filter
@endsection

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Filter /</span> Produk</h4>
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="filter-product-form" class="row g-3 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" onsubmit="false">
                        <div class="col-12">
                            <h6 class="fw-semibold">Atribut Produk</h6>
                            <hr class="mt-0">
                        </div>

                        <div class="col-md-12 fv-plugins-icon-container">
                            <label class="form-label" for="price_id">Harga</label>
                            <select name="price_id" id="price_id" class="form-select">
                                <option value="" selected>Pilih Harga</option>
                                @foreach ($prices as $price)
                                    <option value="{{ $price->id }}">@rupiah($price->price)</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 fv-plugins-icon-container">
                            <label class="form-label d-block">Temperatur</label>
                            @foreach ($temperatures as $temperature)
                            <div class="form-check form-check-inline mb-2">
                                <input class="form-check-input" type="radio" name="temperature_id" id="{{ $temperature->id }}" value="{{ $temperature->id }}">
                                <label class="form-check-label" for="{{ $temperature->id }}">{{ $temperature->name }}</label>
                            </div>
                            @endforeach
                        </div>

                        <div class="col-md-4 fv-plugins-icon-container">
                            <label class="form-label d-block">Size</label>
                            @foreach ($sizes as $size)
                            <div class="form-check form-check-inline mb-2">
                                <input class="form-check-input" type="radio" name="size_id" id="{{ $size->id }}" value="{{ $size->id }}">
                                <label class="form-check-label" for="{{ $size->id }}">{{ $size->name }}</label>
                            </div>
                            @endforeach
                        </div>

                        <div class="col-md-4 fv-plugins-icon-container">
                            <label class="form-label d-block">Topping</label>
                            @foreach ($toppings as $topping)
                            <div class="form-check form-check-inline mb-2">
                                <input class="form-check-input" type="radio" name="topping_id" id="{{ $topping->id }}" value="{{ $topping->id }}">
                                <label class="form-check-label" for="{{ $topping->id }}">{{ $topping->name }}</label>
                            </div>
                            @endforeach
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Filter</button>
                            <button type="reset" class="btn btn-secondary waves-effect" style="float: right">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <h6 class="fw-semibold">Hasil Filter</h6>
                        <hr class="mt-0">
                    </div>
                    <div id="data-filter-product-result"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <h6 class="fw-semibold">Normalisasi Matrik</h6>
                        <hr class="mt-0">
                    </div>
                    <div id="data-filter-normalization-matrik-result"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <h6 class="fw-semibold">Hasil Perangkingan</h6>
                        <hr class="mt-0">
                    </div>
                    <div id="data-filter-rank-result"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection