@extends('layouts.main')

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">List Invoices</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listInvoiceAdminTable">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Invoice ID</th>
              <th class="text-center">Handle By</th>
              <th class="text-center">Amount</th>
              <th class="text-center">Total</th>
              <th class="text-center">Transaction Date</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
</div>
@endsection