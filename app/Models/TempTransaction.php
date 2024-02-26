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
}
