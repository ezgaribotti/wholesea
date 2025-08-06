<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained();
            $table->foreignId('tracking_status_id')->constrained();
            $table->foreignId('cargo_manifest_id')->constrained();
            $table->foreignId('insurance_policy_id')->constrained();
            $table->decimal('weight');
            $table->decimal('shipping_cost');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
