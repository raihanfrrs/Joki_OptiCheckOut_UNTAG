<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreferencesMatriks extends Model
{
    use HasFactory;

    protected $keyType = "string";
    public $incrementing = false;
    protected $fillable = [
        'id',
        'user_id',
        'normalization_matrik_id',
        'value',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function normalization_matrik()
    {
        return $this->belongsTo(NormalizationMatriks::class);
    }
}
