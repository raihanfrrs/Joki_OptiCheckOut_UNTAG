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

class Cashier extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, LogsActivity;

    protected $keyType = "string";
    public $incrementing = false;
    protected $primaryKey = 'id';

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
        'address',
        'status'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cashier_images')
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
            'created' => 'Cashier created',
            'updated' => 'Cashier updated',
            'deleted' => 'Cashier deleted',
        ];

        return $eventDescriptions[$eventName] ?? "Cashier {$eventName}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public function temp_transaction()
    {
        return $this->hasMany(TempTransaction::class);
    }
}
