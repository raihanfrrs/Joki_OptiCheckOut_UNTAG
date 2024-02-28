<?php 

namespace App\Repositories;

use App\Models\Temperature;

class TemperatureRepository
{
    public function getAllTemperatures()
    {
        return Temperature::all();
    }
}