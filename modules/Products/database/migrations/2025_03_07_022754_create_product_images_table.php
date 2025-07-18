<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->string('path');
            $table->string('full_url');
            $table->string('description');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
