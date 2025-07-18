<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracking_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('priority');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracking_statuses');
    }
};
