<?php

namespace App\Repositories;

use App\Models\Size;

class SizeRepository
{
    public function getAllSizes()
    {
        return Size::all();
    }

    public function getSize($id)
    {
        return Size::find($id);
    }

    public function getMaximumSize()
    {
        return Size::join('ratings', 'sizes.rating_id', '=', 'ratings.id')->max('rating');
    }
}