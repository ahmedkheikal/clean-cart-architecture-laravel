<?php

namespace App\Infrastructure\Persistance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'amount',
        'status',
        'payment_method',
        'transaction_id'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
} 