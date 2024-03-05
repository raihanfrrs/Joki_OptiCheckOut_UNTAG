<form action="{{ auth()->user()->level == 'admin' ? route('admin.matrik.store') : route('cashier.matrik.store') }}" method="POST" class="row g-3">
    @csrf
    <div class="col-12 col-md-12">
      <label class="form-label" for="product_id">Produk</label>
      <select name="product_id" id="product_id" class="form-select">
        @foreach ($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
        @endforeach
      </select>
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