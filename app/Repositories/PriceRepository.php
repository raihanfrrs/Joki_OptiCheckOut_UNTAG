<?php

namespace App\Repositories;

use App\Models\Price;

class PriceRepository
{
    
    public function getAllPrices()
    {
        return Price::orderBy('price')->get();
    }

    public function getPrice($id)
    {
        return Price::find($id);
    }

    public function getMinimumPrice()
    {
        return Price::join('ratings', 'prices.rating_id', '=', 'ratings.id')
                    ->max('rating');
    }
}