<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $keyType = "string";
    protected $fillable = [
        'id',
        'price_id',
        'name',
        'stock',
        'status'
    ];

    public function price()
    {
        return $this->belongsTo(Price::class);
    }
}
