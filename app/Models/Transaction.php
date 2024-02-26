<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $keyType = "string";
    protected $fillable = [
        'id',
        'cashier_id',
        'grand_total'
    ];

    public function cashier()
    {
        return $this->belongsTo(Cashier::class);
    }

    public function detail_transaction()
    {
        return $this->hasMany(DetailTransaction::class);
    }
}
