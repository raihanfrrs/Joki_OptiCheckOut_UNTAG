<div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
            <th>Alternatif</th>
            <th>Kriteria</th>
        </tr>
        <tr>
            <th></th>
            <th>Harga</th>
            <th>Temperatur</th>
            <th>Size</th>
            <th>Topping</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($filters as $filter)
        <tr>
            <td>{{ $filter->name }}</td>
            <td>{{ round($filter->price->rating->rating / $minimun_price, 2) }}</td>
            <td>{{ round($maximum_temperature / $filter->temperature->rating->rating, 2) }}</td>
            <td>{{ round($maximum_size / $filter->size->rating->rating, 2) }}</td>
            <td>{{ round($maximum_topping / $filter->topping->rating->rating, 2) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>