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