<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $keyType = "string";
    public $incrementing = false;
    protected $fillable = [
        'id',
        'cashier_id',
        'grand_total'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        $eventDescriptions = [
            'created' => 'Transaction created',
            'updated' => 'Transaction updated',
            'deleted' => 'Transaction deleted',
        ];

        return $eventDescriptions[$eventName] ?? "Transaction {$eventName}";
    }

    public function cashier()
    {
        return $this->belongsTo(Cashier::class);
    }

    public function detail_transaction()
    {
        return $this->hasMany(DetailTransaction::class);
    }
}
