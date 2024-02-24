<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    use HasFactory;

    protected $keyType = "string";
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'email',
        'phone',
        'pob',
        'dob',
        'gender',
        'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
