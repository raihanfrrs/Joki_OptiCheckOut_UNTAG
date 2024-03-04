<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    protected $keyType = "string";
    protected $fillable = [
        'id',
        'rating_id',
        'name'
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function rating()
    {
        return $this->belongsTo(Rating::class);
    }

    public function alternative_matrik()
    {
        return $this->hasMany(AlternativeMatriks::class);
    }
}
