<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Admin extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $keyType = "string";
    protected $fillable = [
        'id',
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'pob',
        'dob',
        'gender',
        'address'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('admin_images')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cashier()
    {
        return $this->hasOne(Cashier::class);
    }
}
