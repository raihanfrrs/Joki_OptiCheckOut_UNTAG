<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Admin extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, LogsActivity;

    protected $keyType = "string";
    public $incrementing = false;
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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        $eventDescriptions = [
            'created' => 'Admin created',
            'updated' => 'Admin updated',
            'deleted' => 'Admin deleted',
        ];

        return $eventDescriptions[$eventName] ?? "Admin {$eventName}";
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
