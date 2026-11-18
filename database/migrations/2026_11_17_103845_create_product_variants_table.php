<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('sku', 80)->unique();
            $table->string('size', 16);
            $table->string('color', 40);
            $table->decimal('price_adjustment', 12, 2)->default(0);
            $table->integer('stock_qty')->default(0);
            $table->timestamps();

            $table->unique(['product_id', 'size', 'color']);
            $table->index('product_id');
        });

        DB::statement('ALTER TABLE product_variants ADD CONSTRAINT chk_variants_stock_non_negative CHECK (stock_qty >= 0)');
    }

    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
