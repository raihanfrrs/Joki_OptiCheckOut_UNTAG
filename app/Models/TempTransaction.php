<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempTransaction extends Model
{
    use HasFactory;
    protected $keyType = "string";
    protected $fillable = [
        'id',
        'cashier_id',
        'product_id',
        'temperature_id',
        'size_id',
        'topping_id',
        'qty',
        'subtotal'
    ];

    public function cashier()
    {
        return $this->belongsTo(Cashier::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
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
}
