<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    public function run(): void
    {
        $vouchers = [
            [
                'code' => 'SDMN10',
                'discount_type' => 'percentage',
                'discount_value' => 10,
                'min_spend' => 500000,
                'usage_limit' => 100,
                'used_count' => 0,
                'starts_at' => now()->subDay(),
                'expires_at' => now()->addMonths(3),
                'is_active' => true,
            ],
            [
                'code' => 'DROP50K',
                'discount_type' => 'fixed',
                'discount_value' => 50000,
                'min_spend' => 350000,
                'usage_limit' => 50,
                'used_count' => 0,
                'starts_at' => now()->subDay(),
                'expires_at' => now()->addMonths(3),
                'is_active' => true,
            ],
        ];

        foreach ($vouchers as $item) {
            Voucher::updateOrCreate(['code' => $item['code']], $item);
        }
    }
}
