<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $keyType = "string";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name'
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
