<form action="{{ route('inventory.product.update', $product->id) }}" method="POST" class="row g-3">
    @csrf
    @method('PATCH')
    <div class="col-12 col-md-12">
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