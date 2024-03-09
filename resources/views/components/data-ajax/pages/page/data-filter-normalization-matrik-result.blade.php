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
            <th>Suhu</th>
            <th>Topping</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($filters as $filter)
        <tr>
            <td>{{ $filter->name }}</td>
            <td>{{ round($minimun_price / $filter->price->rating->rating, 2) }}</td>
            <td>{{ round($filter->temperature->rating->rating / $maximum_temperature, 2) }}</td>
            <td>{{ round($filter->size->rating->rating / $maximum_size, 2) }}</td>
            <td>{{ round($filter->topping->rating->rating / $maximum_topping, 2) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>