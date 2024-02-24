<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    use HasFactory;
    protected $keyType = "string";
    protected $fillable = [
        'id',
        'rating_id',
        'name'
    ];

    public function rating()
    {
        return $this->belongsTo(Rating::class);
    }
}
