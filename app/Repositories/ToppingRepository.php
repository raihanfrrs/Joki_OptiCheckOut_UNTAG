<?php

namespace App\Repositories;

use App\Models\Topping;

class ToppingRepository
{
    public function getAllToppings()
    {
        return Topping::all();
    }
}