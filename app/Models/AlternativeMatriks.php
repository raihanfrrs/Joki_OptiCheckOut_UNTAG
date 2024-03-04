<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternativeMatriks extends Model
{
    use HasFactory;
    protected $keyType = "string";
    public $incrementing = false;
    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'price_id',
        'temperature_id',
        'size_id',
        'topping_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }

    public function temperature()
    {
        return $this->belongsTo(Temperature::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function topping()
    {
        return $this->belongsTo(Topping::class);
    }

    public function normalization_matrik()
    {
        return $this->hasOne(NormalizationMatriks::class);
    }
}
