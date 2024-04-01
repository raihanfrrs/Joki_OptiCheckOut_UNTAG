<?php

namespace App\Repositories;

use App\Models\Topping;

class ToppingRepository
{
    public function getAllToppings()
    {
        return Topping::all();
    }

    public function getTopping($id)
    {
        return Topping::find($id);
    }

    public function getMaximumTopping()
    {
        return Topping::join('ratings', 'toppings.rating_id', '=', 'ratings.id')->min('rating');
    }
}