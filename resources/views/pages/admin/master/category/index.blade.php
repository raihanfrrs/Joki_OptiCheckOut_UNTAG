@extends('layouts.main')

@section('title')
  Master - Category
@endsection

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">Daftar Kategori</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listMasterCategoryTable">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Kategori</th>
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
          <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Kategori Formulir</h5>
          <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
          <form action="{{ route('master.category.store') }}" method="POST" class="add-new-user pt-0" id="addNewCategoryForm">
            @csrf
            <div class="mb-3">
              <label class="form-label" for="name">Kategori</label>
              <input
                type="text"
                class="form-control"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="Kategori"
                required />
                @error('name')
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