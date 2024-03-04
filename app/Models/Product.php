<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, LogsActivity;
    protected $keyType = "string";
    public $incrementing = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'price_id',
        'category_id',
        'name',
        'stock',
        'status'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product_images')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        $productName = $this->name ?? 'Unknown Product';

        return "Product '{$productName}' has been {$eventName}";
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function detail_transaction()
    {
        return $this->hasMany(DetailTransaction::class);
    }

    public function temp_transaction()
    {
        return $this->hasMany(TempTransaction::class);
    }

    public function alternative_matrik()
    {
        return $this->hasMany(AlternativeMatriks::class);
    }
}