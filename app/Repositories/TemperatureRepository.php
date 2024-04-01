<?php 

namespace App\Repositories;

use App\Models\Temperature;

class TemperatureRepository
{
    public function getAllTemperatures()
    {
        return Temperature::all();
    }

    public function getTemperature($id)
    {
        return Temperature::find($id);
    }

    public function getMaximumTemperature()
    {
        return Temperature::join('ratings', 'temperatures.rating_id', '=', 'ratings.id')->min('rating');
    }
}