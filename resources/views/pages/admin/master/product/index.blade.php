@extends('layouts.main')

@section('title')
  Master - Product
@endsection

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">Daftar Produk</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listMasterProductTable">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Produk</th>
              <th class="text-center">Kategori</th>
              <th class="text-center">Temperatur</th>
              <th class="text-center">Ukuran</th>
              <th class="text-center">Topping</th>
              <th class="text-center">Stok</th>
              <th class="text-center">Harga</th>
              <th class="text-center">Status</th>
              <th class="text-center"></th>
            </tr>
          </thead>
        </table>
      </div>

      <div
        class="offcanvas offcanvas-end"
        tabindex="-1"
        id="offcanvasAddUser"
        aria-labelledby="offcanvasAddUserLabel">
        <div class="offcanvas-header">
          <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Formulir Produk</h5>
          <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
          <form action="{{ route('master.product.store') }}" method="POST" class="add-new-user pt-0" id="addNewProductForm" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label class="form-label" for="name">Produk</label>
              <input
                type="text"
                class="form-control"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="Produk"
                required />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" for="category_id">Kategori</label>
              <select name="category_id" id="category_id" class="form-select" required>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
              </select>
              @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" for="stock">Stok</label>
              <input
                type="number"
                class="form-control"
                id="stock"
                name="stock"
                value="{{ old('stock') }}"
                min="1"
                placeholder="Stock"
                required />
                @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" for="name">Harga</label>
              <select name="price_id" id="price_id" class="form-select" required>
                @foreach ($prices as $price)
                  <option value="{{ $price->id }}" {{ old('price_id') == $price->id ? 'selected' : '' }}>@rupiah($price->price)</option>
                @endforeach
              </select>
              @error('price_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label d-block">Temperatur</label>
              <div class="form-check form-check-inline mb-2">
                <input class="form-check-input" type="radio" name="temperature_id" id="{{ $temperatures[0]->id }}" value="{{ $temperatures[0]->id }}" {{ old('temperature_id') == $temperatures[0]->id ? 'checked' : '' }}>
                <label class="form-check-label" for="{{ $temperatures[0]->id }}">{{ $temperatures[0]->name }}</label>
              </div>
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="temperature_id" id="{{ $temperatures[1]->id }}" value="{{ $temperatures[1]->id }}" {{ old('temperature_id') == $temperatures[1]->id ? 'checked' : '' }}>
                  <label class="form-check-label" for="{{ $temperatures[1]->id }}">{{ $temperatures[1]->name }}</label>
              </div>
              @error('temperature_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label d-block">Ukuran</label>
              <div class="form-check form-check-inline mb-2">
                <input class="form-check-input" type="radio" name="size_id" id="{{ $sizes[0]->id }}" value="{{ $sizes[0]->id }}" {{ old('size_id') == $sizes[0]->id ? 'checked' : '' }}>
                <label class="form-check-label" for="{{ $sizes[0]->id }}">{{ $sizes[0]->name }}</label>
              </div>
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="size_id" id="{{ $sizes[1]->id }}" value="{{ $sizes[1]->id }}" {{ old('size_id') == $sizes[1]->id ? 'checked' : '' }}>
                  <label class="form-check-label" for="{{ $sizes[1]->id }}">{{ $sizes[1]->name }}</label>
              </div>
              @error('size_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label d-block">Topping</label>
              <div class="form-check form-check-inline mb-2">
                <input class="form-check-input" type="radio" name="topping_id" id="{{ $toppings[0]->id }}" value="{{ $toppings[0]->id }}" {{ old('topping_id') == $toppings[0]->id ? 'checked' : '' }}>
                <label class="form-check-label" for="{{ $toppings[0]->id }}">{{ $toppings[0]->name }}</label>
              </div>
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="topping_id" id="{{ $toppings[1]->id }}" value="{{ $toppings[1]->id }}" {{ old('topping_id') == $toppings[1]->id ? 'checked' : '' }}>
                  <label class="form-check-label" for="{{ $toppings[1]->id }}">{{ $toppings[1]->name }}</label>
              </div>
              @error('topping_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" for="image">Foto Produk</label>
              <input type="file" class="form-control" id="image" name="product_image" onchange="previewImage()" required>
              <img class="img-fluid img-preview mt-2">
              @error('product_image')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Kirim</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Batal</button>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection