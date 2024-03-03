<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $keyType = "string";
    public $incrementing = false;
    protected $primaryKey = 'id';


    protected $fillable = [
        'id',
        'name'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        $categoryName = $this->name ?? 'Unknown Category';

        return "Product '{$categoryName}' has been {$eventName}";
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
