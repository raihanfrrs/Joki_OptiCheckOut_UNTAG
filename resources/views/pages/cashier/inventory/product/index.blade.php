@extends('layouts.main')

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">Daftar Produk</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listInventoryProductTable">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Produk</th>
              <th class="text-center">Kategori</th>
              <th class="text-center">Stok</th>
              <th class="text-center">Harga</th>
              <th class="text-center">Status</th>
              <th class="text-center"></th>
            </tr>
          </thead>
        </table>
      </div>

    </div>
</div>
@endsection