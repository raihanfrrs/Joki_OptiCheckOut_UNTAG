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
        <h4 class="fw-bold">FAKTUR #{{ preg_replace('/[^0-9]/', '', head(explode('-', $transaction->id))) }}</h4>
        <div class="mb-2">
            <span>Tanggal Pembayaran:</span>
            <span class="fw-semibold">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d F, Y') }}</span>
        </div>
        <div>
            <span>Waktu Pembayaran:</span>
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
            <th>Produk</th>
            <th>Temperatur</th>
            <th>Ukuran</th>
            <th>Topping</th>
            <th>Jumlah</th>
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
                <td colspan="5" class="align-top px-4 py-3">
                    <p class="mb-2">
                        <span class="me-1 fw-bold">Kasir:</span>
                        <span>{{ $transaction->cashier->first_name }} {{ $transaction->cashier->last_name }}</span>
                    </p>
                    <span>Terima kasih atas pembelian anda</span>
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