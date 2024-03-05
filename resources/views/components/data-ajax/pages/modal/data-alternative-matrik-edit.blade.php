<form action="{{ auth()->user()->level == 'admin' ? route('admin.matrik.update', $alternative_matrik->id) : route('cashier.matrik.update', $alternative_matrik->id) }}" method="POST" class="row g-3">
    @csrf
    @method('PATCH')
    <div class="col-12 col-md-12">
      <label class="form-label" for="price_id">Harga</label>
      <select name="price_id" id="price_id" class="form-select">
        @foreach ($prices as $price)
            <option value="{{ $price->id }}" {{ $alternative_matrik->price_id == $price->id ? 'selected' : '' }}>{{ $price->price }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label d-block">Temperatur</label>
        <div class="row">
            <div class="col-6">
                <div class="form-check form-check-inline mb-2">
                    <input class="form-check-input" type="radio" name="temperature_id" id="{{ $temperature[0]->id }}" value="{{ $temperature[0]->id }}" {{ $alternative_matrik->temperature_id == $temperature[0]->id ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $temperature[0]->id }}">{{ $temperature[0]->name }}</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="temperature_id" id="{{ $temperature[1]->id }}" value="{{ $temperature[1]->id }}" {{ $alternative_matrik->temperature_id == $temperature[1]->id ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $temperature[1]->id }}">{{ $temperature[1]->name }}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label d-block">Ukuran</label>
        <div class="row">
            <div class="col-6">
                <div class="form-check form-check-inline mb-2">
                    <input class="form-check-input" type="radio" name="size_id" id="{{ $size[0]->id }}" value="{{ $size[0]->id }}" {{ $alternative_matrik->size_id == $size[0]->id ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $size[0]->id }}">{{ $size[0]->name }}</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="size_id" id="{{ $size[1]->id }}" value="{{ $size[1]->id }}" {{ $alternative_matrik->size_id == $size[1]->id ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $size[1]->id }}">{{ $size[1]->name }}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label d-block">Topping</label>
        <div class="row">
            <div class="col-6">
                <div class="form-check form-check-inline mb-2">
                    <input class="form-check-input" type="radio" name="topping_id" id="{{ $topping[0]->id }}" value="{{ $topping[0]->id }}" {{ $alternative_matrik->topping_id == $topping[0]->id ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $topping[0]->id }}">{{ $topping[0]->name }}</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="topping_id" id="{{ $topping[1]->id }}" value="{{ $topping[1]->id }}" {{ $alternative_matrik->topping_id == $topping[1]->id ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $topping[1]->id }}">{{ $topping[1]->name }}</label>
                </div>
            </div>
        </div>
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