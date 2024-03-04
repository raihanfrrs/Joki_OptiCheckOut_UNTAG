<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NormalizationMatriks extends Model
{
    use HasFactory;
    protected $keyType = "string";
    public $incrementing = false;
    protected $fillable = [
        'id',
        'user_id',
        'alternative_matrik_id',
        'name',
        'price',
        'temperature',
        'size',
        'topping'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alternative_matrik()
    {
        return $this->belongsTo(AlternativeMatriks::class);
    }

    public function preferences_matrik()
    {
        return $this->hasOne(PreferencesMatriks::class);
    }
}
