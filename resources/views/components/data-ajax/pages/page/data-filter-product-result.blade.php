<div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Produk</th>
          <th>Kategori</th>
          <th>Temperatur</th>
          <th>Size</th>
          <th>Topping</th>
          <th>Harga</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($filters as $filter)
        <tr>
            <td>{{ $filter->name }}</td>
            <td>{{ $filter->category->name }}</td>
            <td>{{ $filter->temperature->name }}</td>
            <td>{{ $filter->size->name }}</td>
            <td>{{ $filter->topping->name }}</td>
            <td>@rupiah($filter->price->price)</td>
            <td class="text-center">
                <button class="btn btn-sm btn-primary" id="button-filter-product-add-alternative-matrik" data-id="{{ $filter->id }}"><i class="ti ti-plus me-2"></i> SPK SAW</button>
                @if (auth()->user()->level == 'cashier')
                    <button class="btn btn-sm btn-success" id="button-filter-product-add-shopping-cart" data-id="{{ $filter->id }}"><i class="ti ti-shopping-cart me-2"></i> Keranjang</button>
                @endif
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>