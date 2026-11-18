<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code', 40)->unique();
            $table->string('discount_type', 20); // 'percentage' | 'fixed'
            $table->decimal('discount_value', 12, 2);
            $table->decimal('min_spend', 12, 2)->default(0);
            $table->integer('usage_limit')->nullable();
            $table->integer('used_count')->default(0);
            $table->timestampTz('starts_at')->nullable();
            $table->timestampTz('expires_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::statement("ALTER TABLE vouchers ADD CONSTRAINT chk_vouchers_type CHECK (discount_type IN ('percentage', 'fixed'))");
        DB::statement('ALTER TABLE vouchers ADD CONSTRAINT chk_vouchers_value_positive CHECK (discount_value > 0)');
        DB::statement('ALTER TABLE vouchers ADD CONSTRAINT chk_vouchers_usage CHECK (usage_limit IS NULL OR used_count <= usage_limit)');
    }

    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
