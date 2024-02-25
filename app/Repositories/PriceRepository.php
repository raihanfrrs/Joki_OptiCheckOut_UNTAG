<?php

namespace App\Repositories;

use App\Models\Price;

class PriceRepository
{
    
    public function getAllPrices()
    {
        return Price::orderBy('price')->get();
    }

}