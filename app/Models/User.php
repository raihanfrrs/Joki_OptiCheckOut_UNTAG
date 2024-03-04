<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, LogsActivity;

    protected $keyType = "string";
    public $incrementing = false;
    protected $fillable = [
        'id',
        'username',
        'password',
        'level'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        $eventDescriptions = [
            'created' => 'User created',
            'updated' => 'User updated',
            'deleted' => 'User deleted',
        ];

        return $eventDescriptions[$eventName] ?? "User {$eventName}";
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function cashier()
    {
        return $this->hasOne(Cashier::class);
    }

    public function alternative_matrik()
    {
        return $this->hasMany(AlternativeMatriks::class);
    }

    public function normalization_matrik()
    {
        return $this->hasMany(NormalizationMatriks::class);
    }

    public function preferences_matrik()
    {
        return $this->hasMany(PreferencesMatriks::class);
    }
}
