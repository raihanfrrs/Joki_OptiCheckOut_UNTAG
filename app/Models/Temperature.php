<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temperature extends Model
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

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    // public function temp_transaction()
    // {
    //     return $this->hasMany(TempTransaction::class);
    // }

    // public function detail_transaction()
    // {
    //     return $this->hasMany(DetailTransaction::class);
    // }

    public function alternative_matrik()
    {
        return $this->hasMany(AlternativeMatriks::class);
    }
}
