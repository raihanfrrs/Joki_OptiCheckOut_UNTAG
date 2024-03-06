<form action="{{ route('master.product.update', $product->id) }}" method="POST" class="row g-3" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="col-6 col-md-6">
      <label class="form-label" for="name">Produk</label>
      <input
        type="text"
        id="name"
        name="name"
        class="form-control"
        value="{{ old('name', $product->name) }}" 
        placeholder="Produk"
        required/>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-6 col-md-6">
      <label class="form-label" for="category_id">Kategori</label>
      <select name="category_id" id="category_id" class="form-select">
          @foreach ($categories as $category)
              <option value="{{ $category->id }}" {{ old('category_id', $category->price_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
          @endforeach
      </select>
      @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-6 col-md-6">
      <label class="form-label" for="stock">Stok</label>
      <input
        type="number"
        id="stock"
        name="stock"
        class="form-control"
        value="{{ old('stock', $product->stock) }}" 
        required
        placeholder="Stok"
        min="1" />
        @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-6 col-md-6">
        <label class="form-label" for="price_id">Harga</label>
        <select name="price_id" id="price_id" class="form-select">
            @foreach ($prices as $price)
                <option value="{{ $price->id }}" {{ old('price_id', $product->price_id) == $price->id ? 'selected' : '' }}>@rupiah($price->price)</option>
            @endforeach
        </select>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-4 col-md-4">
        <label class="form-label d-block">Temperatur</label>
        <div class="form-check form-check-inline mb-2">
          <input class="form-check-input" type="radio" name="temperature_id" id="{{ $temperatures[0]->id }}" value="{{ $temperatures[0]->id }}" {{ old('temperature_id', $product->temperature_id) == $temperatures[0]->id ? 'checked' : '' }}>
          <label class="form-check-label" for="{{ $temperatures[0]->id }}">{{ $temperatures[0]->name }}</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="temperature_id" id="{{ $temperatures[1]->id }}" value="{{ $temperatures[1]->id }}" {{ old('temperature_id', $product->temperature_id) == $temperatures[1]->id ? 'checked' : '' }}>
            <label class="form-check-label" for="{{ $temperatures[1]->id }}">{{ $temperatures[1]->name }}</label>
        </div>
        @error('temperature_id')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-4 col-md-4">
        <label class="form-label d-block">Ukuran</label>
        <div class="form-check form-check-inline mb-2">
          <input class="form-check-input" type="radio" name="size_id" id="{{ $sizes[0]->id }}" value="{{ $sizes[0]->id }}" {{ old('size_id', $product->size_id) == $sizes[0]->id ? 'checked' : '' }}>
          <label class="form-check-label" for="{{ $sizes[0]->id }}">{{ $sizes[0]->name }}</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="size_id" id="{{ $sizes[1]->id }}" value="{{ $sizes[1]->id }}" {{ old('size_id', $product->size_id) == $sizes[1]->id ? 'checked' : '' }}>
            <label class="form-check-label" for="{{ $sizes[1]->id }}">{{ $sizes[1]->name }}</label>
        </div>
        @error('size_id')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-4 col-md-4">
        <label class="form-label d-block">Topping</label>
        <div class="form-check form-check-inline mb-2">
          <input class="form-check-input" type="radio" name="topping_id" id="{{ $toppings[0]->id }}" value="{{ $toppings[0]->id }}" {{ old('topping_id', $product->topping_id) == $toppings[0]->id ? 'checked' : '' }}>
          <label class="form-check-label" for="{{ $toppings[0]->id }}">{{ $toppings[0]->name }}</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="topping_id" id="{{ $toppings[1]->id }}" value="{{ $toppings[1]->id }}" {{ old('topping_id', $product->topping_id) == $toppings[1]->id ? 'checked' : '' }}>
            <label class="form-check-label" for="{{ $toppings[1]->id }}">{{ $toppings[1]->name }}</label>
        </div>
        @error('topping_id')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="image">Foto</label>
        <input type="file" name="product_image" id="image" class="form-control" onchange="previewImage()">
        <img class="img-fluid img-preview mt-2 w-50" src="{{ $product->getFirstMediaUrl('product_images') }}">
        @error('product_image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 text-center">
      <button type="submit" class="btn btn-primary me-sm-3 me-1">Kirim</button>
      <button
        type="reset"
        class="btn btn-label-secondary"
        data-bs-dismiss="modal"
        aria-label="Close">
        Batal
      </button>
    </div>
</form>

<script src="{{ asset('js/prev-image.js') }}"></script>