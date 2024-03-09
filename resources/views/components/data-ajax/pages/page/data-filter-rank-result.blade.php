<div class="table-responsive text-nowrap">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Alternatif</th>
                <th>Nilai</th>
                <th>Ranking</th>
                <th style="width: 25%">Foto</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            <?php
            $filteredResults = [];

            foreach ($filters as $filter) {
                $value = round((($minimun_price / $filter->price->rating->rating) * 4) + (($filter->temperature->rating->rating / $maximum_temperature) * 3) + (($filter->size->rating->rating / $maximum_size) * 2) + (($filter->topping->rating->rating / $maximum_topping) * 1), 2);

                $filteredResults[] = [
                    'filter' => $filter,
                    'value' => $value,
                ];
            }

            // Sorting menggunakan Bubble Sort
            $n = count($filteredResults);
            for ($i = 0; $i < $n - 1; $i++) {
                for ($j = 0; $j < $n - $i - 1; $j++) {
                    if ($filteredResults[$j]['value'] < $filteredResults[$j + 1]['value']) {
                        // swap
                        $temp = $filteredResults[$j];
                        $filteredResults[$j] = $filteredResults[$j + 1];
                        $filteredResults[$j + 1] = $temp;
                    }
                }
            }

            $rank = 1;

            foreach ($filteredResults as $result):
            ?>
                <tr>
                    <td>{{ $result['filter']->name }}</td>
                    <td>{{ $result['value'] }}</td>
                    <td>{{ $rank++ }}</td>
                    <td><img src="{{ asset($result['filter']->getFirstMediaUrl('product_images')) }}" class="img-fluid w-75"></td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-primary" id="button-filter-product-add-alternative-matrik" data-id="{{ $filter->id }}"><i class="ti ti-plus me-2"></i> SPK SAW</button>
                        @if (auth()->user()->level == 'cashier')
                            <button class="btn btn-sm btn-success" id="button-filter-product-add-shopping-cart" data-id="{{ $filter->id }}"><i class="ti ti-shopping-cart me-2"></i> Keranjang</button>
                        @endif
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>