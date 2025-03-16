<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_number')->unique();
            $table->enum('status', ['in_progress', 'paid', 'canceled'])->default('in_progress');
            $table->foreignId('customer_address_id')->constrained();
            $table->decimal('total_amount')->default(0);
            $table->string('external_reference')->nullable();
            $table->timestamp('issued_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
