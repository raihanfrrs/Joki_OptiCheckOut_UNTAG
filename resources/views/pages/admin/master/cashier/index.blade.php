@extends('layouts.main')

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">List Cashier</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listMasterCashierTable">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Cashier</th>
              <th class="text-center">Email</th>
              <th class="text-center">Phone</th>
              <th class="text-center">Place & Date of Birth</th>
              <th class="text-center">Gender</th>
              <th class="text-center">Address</th>
              <th class="text-center">Registered At</th>
              <th class="text-center">Status</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
        </table>
      </div>

    </div>
</div>
@endsection