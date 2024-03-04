@extends('layouts.main')

@section('section-print')
<table class="table m-0">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Kasir</th>
            <th>Produk</th>
            <th>Temperatur</th>
            <th>Ukuran</th>
            <th>Topping</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $item)
        <tr>
            <td class="text-nowrap">{{ $loop->iteration }}</td>
            <td class="text-nowrap text-capitalize">{{ $item->cashier->first_name }} {{ $item->cashier->last_name }}</td>
            <td class="text-nowrap text-capitalize">{{ $item->product_name }}</td>
            <td class="text-capitalize">{{ $item->temperature }}</td>
            <td class="text-capitalize">{{ $item->size }}</td>
            <td class="text-capitalize">{{ $item->topping }}</td>
            <td class="text-nowrap">@rupiah($item->price)</td>
            <td class="text-nowrap">{{ $item->qty }}</td>
            <td class="text-nowrap">@rupiah($item->subtotal)</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="7" class="align-top px-4 py-3"></td>
            <td class="text-start">
                <p class="mb-0 pb-3">Grand Total:</p>
            </td>
            <td>
                <p class="fw-semibold mb-0 pb-3">@rupiah($transactions->sum('subtotal'))</p>
            </td>
        </tr>
    </tbody>
</table>
@endsection