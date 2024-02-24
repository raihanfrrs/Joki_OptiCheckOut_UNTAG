<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $keyType = "string";
    protected $fillable = [
        'id',
        'name'
    ];

    public function price()
    {
        return $this->hasOne(Price::class);
    }

    public function temperature()
    {
        return $this->hasOne(Temperature::class);
    }

    public function topping()
    {
        return $this->hasOne(Topping::class);
    }

    public function size()
    {
        return $this->hasOne(Size::class);
    }
}
