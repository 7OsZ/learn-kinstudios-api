<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'order_id',
    'provider',
    'external_id',
    'snap_token',
    'redirect_url',
    'payment_type',
    'transaction_status',
    'payload_json',
    'paid_at',
])]
class Payment extends Model
{
    protected function casts(): array
    {
        return [
            'payload_json' => 'array',
            'paid_at' => 'datetime',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
