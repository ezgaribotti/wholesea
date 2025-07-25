<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->decimal('fixed_price');
            $table->integer('quantity');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
