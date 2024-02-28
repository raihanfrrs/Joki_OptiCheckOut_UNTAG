<?php

namespace App\Repositories;

use App\Models\Size;

class SizeRepository
{
    public function getAllSizes()
    {
        return Size::all();
    }
}