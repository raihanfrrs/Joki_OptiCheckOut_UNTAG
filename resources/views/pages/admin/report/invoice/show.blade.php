@extends('layouts.main')

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row invoice-preview">

      <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
        <div class="card invoice-preview-card">
          <div class="card-body">
            <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
              <div class="mb-xl-0 mb-4">
                <p class="mb-2">Jl. Merdeka No. 17A, Jakarta</p>
                <p class="mb-2">DKI Jakarta, 12345, Indonesia</p>
                <p class="mb-0">+62 1234 5678</p>
              </div>
              <div>
                <h4 class="fw-semibold mb-2">INVOICE #{{ preg_replace('/[^0-9]/', '', head(explode('-', $transaction->id))) }}</h4>
                <div class="mb-2 pt-1">
                  <span>Date Payment:</span>
                  <span class="fw-semibold">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d F, Y') }}</span>
                </div>
                <div class="mb-2 pt-1">
                  <span>Time Payment:</span>
                  <span class="fw-semibold">{{ \Carbon\Carbon::parse($transaction->created_at)->format('H:i:s') }}</span>
                </div>
              </div>
            </div>
          </div>
          <hr class="my-0">
          <div class="table-responsive border-top">
            <table class="table m-0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Product</th>
                  <th>Temperature</th>
                  <th>Size</th>
                  <th>Topping</th>
                  <th>Qty</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($transaction->detail_transaction as $item)
                <tr>
                    <td class="text-nowrap">{{ $loop->iteration }}</td>
                    <td class="text-nowrap text-capitalize">{{ $item->product->name }}</td>
                    <td class="text-capitalize">{{ $item->temperature->name }}</td>
                    <td class="text-capitalize">{{ $item->size->name }}</td>
                    <td class="text-capitalize">{{ $item->topping->name }}</td>
                    <td class="text-nowrap">{{ $item->qty }}</td>
                    <td class="text-nowrap">@rupiah($item->product->price->price)</td>
                </tr>
                @endforeach
                <tr>
                  <td colspan="5" class="align-top px-4 py-4">
                    <p class="mb-2 mt-3">
                      <span class="ms-3 fw-semibold">Cashier:</span>
                      <span class="text-capitalize">{{ $transaction->cashier->first_name }} {{ $transaction->cashier->last_name }}</span>
                    </p>
                  </td>
                  <td class="text-end pe-3 py-4">
                    <p class="mb-2 pt-3">Subtotal:</p>
                    <p class="mb-0 pb-3">Grand Total:</p>
                  </td>
                  <td class="ps-2 py-4">
                    <p class="fw-semibold mb-2 pt-3">@rupiah($transaction->detail_transaction->sum('subtotal'))</p>
                    <p class="fw-semibold mb-0 pb-3">@rupiah($transaction->grand_total)</p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>

      <div class="col-xl-3 col-md-4 col-12 invoice-actions">
        <div class="card">
          <div class="card-body">
            <button class="btn btn-label-secondary d-grid w-100 mb-2 waves-effect">Download</button>
            <a class="btn btn-label-secondary d-grid w-100 mb-2 waves-effect" target="_blank" href="{{ route('admin.invoice.print', $transaction->id) }}">
              Print
            </a>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection