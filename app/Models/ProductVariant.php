<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['product_id', 'sku', 'size', 'color', 'price_adjustment', 'stock_qty'])]
class ProductVariant extends Model
{
    protected function casts(): array
    {
        return [
            'price_adjustment' => 'decimal:2',
            'stock_qty' => 'integer',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getEffectivePriceAttribute(): float
    {
        $base = (float) ($this->product?->base_price ?? 0);

        return $base + (float) $this->price_adjustment;
    }
}
