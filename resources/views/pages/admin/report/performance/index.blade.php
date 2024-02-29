@extends('layouts.main')

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">Performance Report</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listPerformanceReportAdminTable">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Cashier</th>
              <th class="text-center">Transaction</th>
              <th class="text-center">Quantity Sold</th>
              <th class="text-center">Income</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
        </table>
      </div>

    </div>
</div>
@endsection