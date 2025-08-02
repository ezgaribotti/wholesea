<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transport_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('deviation_factor')->default(1);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transport_types');
    }
};
