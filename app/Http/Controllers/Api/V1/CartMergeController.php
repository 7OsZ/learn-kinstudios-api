<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Cart\MergeCartRequest;
use App\Models\Cart;
use App\Models\ProductVariant;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CartMergeController extends Controller
{
    use ApiResponse;

    public function __invoke(MergeCartRequest $request): JsonResponse
    {
        $user = $request->user();
        $incomingItems = $request->validated()['items'];

        $cart = DB::transaction(function () use ($user, $incomingItems) {
            $cart = Cart::firstOrCreate(['user_id' => $user->id]);

            $variantIds = collect($incomingItems)->pluck('product_variant_id')->unique();
            $variants = ProductVariant::whereIn('id', $variantIds)->get()->keyBy('id');

            foreach ($incomingItems as $item) {
                $variant = $variants->get($item['product_variant_id']);

                if (! $variant || $variant->stock_qty <= 0) {
                    continue;
                }

                $existing = $cart->items()
                    ->where('product_variant_id', $variant->id)
                    ->first();

                $desiredQty = ($existing?->quantity ?? 0) + (int) $item['quantity'];
                $clampedQty = min($desiredQty, $variant->stock_qty);

                if ($clampedQty > 0) {
                    $cart->items()->updateOrCreate(
                        ['product_variant_id' => $variant->id],
                        ['quantity' => $clampedQty]
                    );
                }
            }

            return $cart->load(['items.variant.product.primaryImage']);
        });

        return $this->ok([
            'cart_id' => $cart->id,
            'items_count' => $cart->items->sum('quantity'),
            'items' => $cart->items->map(fn($ci) => [
                'id' => $ci->id,
                'product_variant_id' => $ci->product_variant_id,
                'quantity' => $ci->quantity,
                'sku' => $ci->variant->sku,
                'size' => $ci->variant->size,
                'color' => $ci->variant->color,
                'stock_qty' => $ci->variant->stock_qty,
                'unit_price' => $ci->variant->effective_price,
                'product_name' => $ci->variant->product->name,
                'product_slug' => $ci->variant->product->slug,
                'image_url' => $ci->variant->product->primaryImage?->image_url,
            ]),
        ], 'Guest cart merged successfully.');
    }
}
