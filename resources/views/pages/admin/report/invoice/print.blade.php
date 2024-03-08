@extends('layouts.main')

@section('section-print')
<div class="invoice-print p-5">
    <div class="d-flex justify-content-between flex-row">
      <div class="mb-4">
        <p class="mb-1">Jl. Merdeka No. 17A, Jakarta</p>
        <p class="mb-1">DKI Jakarta, 12345, Indonesia</p>
        <p class="mb-0">+62 1234 5678</p>
      </div>
      <div>
        <h4 class="fw-bold">INVOICE #{{ preg_replace('/[^0-9]/', '', head(explode('-', $transaction->id))) }}</h4>
        <div class="mb-2">
            <span>Date Payment:</span>
            <span class="fw-semibold">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d F, Y') }}</span>
        </div>
        <div>
            <span>Time Payment:</span>
            <span class="fw-semibold">{{ \Carbon\Carbon::parse($transaction->created_at)->format('H:i:s') }}</span>
        </div>
      </div>
    </div>

    <hr>

    <div>
      <table class="table m-0">
        <thead class="table-light">
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
              <td class="text-nowrap text-capitalize">{{ $item->product()->withTrashed()->first()->name }}</td>
              <td class="text-capitalize">{{ $item->product()->withTrashed()->first()->temperature->name }}</td>
              <td class="text-capitalize">{{ $item->product()->withTrashed()->first()->size->name }}</td>
              <td class="text-capitalize">{{ $item->product()->withTrashed()->first()->topping->name }}</td>
              <td class="text-nowrap">{{ $item->qty }}</td>
              <td class="text-nowrap">@rupiah($item->product()->withTrashed()->first()->price->price)</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="5" class="align-top px-4 py-3">
                    <p class="mb-2">
                        <span class="me-1 fw-bold">Cashier:</span>
                        <span class="text-capitalize">{{ $transaction->cashier()->withTrashed()->first()->first_name }} {{ $transaction->cashier()->withTrashed()->first()->last_name }}</span>
                    </p>
                </td>
                <td class="text-end px-4 py-3">
                    <p class="mb-2 pt-3">Subtotal:</p>
                    <p class="mb-0 pb-3">Grand Total:</p>
                </td>
                <td class="px-4 py-3">
                    <p class="fw-semibold mb-2 pt-3">@rupiah($transaction->detail_transaction->sum('subtotal'))</p>
                    <p class="fw-semibold mb-0 pb-3">@rupiah($transaction->grand_total)</p>
                </td>
            </tr>
        </tbody>
      </table>
    </div>

</div>
@endsection