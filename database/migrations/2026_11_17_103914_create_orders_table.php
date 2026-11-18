<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number', 40)->unique();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('voucher_id')->nullable()->constrained('vouchers')->nullOnDelete();
            $table->string('status', 25)->default('pending')->index();
            $table->decimal('subtotal', 12, 2);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('shipping_cost', 12, 2)->default(0);
            $table->decimal('grand_total', 12, 2);
            $table->string('shipping_courier', 40)->nullable();
            $table->jsonb('shipping_address');
            $table->string('tracking_number', 80)->nullable();
            $table->timestampTz('shipped_at')->nullable();
            $table->timestampsTz();

            $table->index(['user_id', 'created_at']);
        });

        DB::statement("ALTER TABLE orders ADD CONSTRAINT chk_orders_status CHECK (status IN ('pending', 'paid', 'processing', 'shipped', 'completed', 'cancelled'))");
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
