@extends('layouts.main')

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">List Products</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listInventoryProductTable">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Product</th>
              <th class="text-center">Category</th>
              <th class="text-center">Stock</th>
              <th class="text-center">Price</th>
              <th class="text-center">Status</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
        </table>
      </div>

    </div>
</div>
@endsection