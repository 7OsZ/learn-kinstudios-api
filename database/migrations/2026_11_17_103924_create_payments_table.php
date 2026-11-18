<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->unique()->constrained('orders')->cascadeOnDelete();
            $table->string('provider', 30)->default('midtrans_sandbox');
            $table->string('external_id', 100)->nullable();
            $table->string('snap_token', 255)->nullable();
            $table->text('redirect_url')->nullable();
            $table->string('payment_type', 40)->nullable();
            $table->string('transaction_status', 40)->default('pending')->index();
            $table->jsonb('payload_json')->nullable();
            $table->timestampTz('paid_at')->nullable();
            $table->timestampsTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
