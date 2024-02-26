<form action="{{ route('master.product.update', $product->id) }}" method="POST" class="row g-3">
    @csrf
    @method('PATCH')
    <div class="col-6 col-md-6">
      <label class="form-label" for="name">Product</label>
      <input
        type="text"
        id="name"
        name="name"
        class="form-control"
        value="{{ old('name', $product->name) }}" 
        required/>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-6 col-md-6">
      <label class="form-label" for="category_id">Category</label>
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
      <label class="form-label" for="stock">Stock</label>
      <input
        type="number"
        id="stock"
        name="stock"
        class="form-control"
        value="{{ old('stock', $product->stock) }}" 
        required
        min="1" />
        @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-6 col-md-6">
        <label class="form-label" for="price_id">Price</label>
        <select name="price_id" id="price_id" class="form-select">
            @foreach ($prices as $price)
                <option value="{{ $price->id }}" {{ old('price_id', $product->price_id) == $price->id ? 'selected' : '' }}>@rupiah($price->price)</option>
            @endforeach
        </select>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 text-center">
      <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
      <button
        type="reset"
        class="btn btn-label-secondary"
        data-bs-dismiss="modal"
        aria-label="Close">
        Cancel
      </button>
    </div>
</form>