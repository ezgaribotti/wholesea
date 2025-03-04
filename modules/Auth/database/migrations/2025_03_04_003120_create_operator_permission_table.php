<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('operator_permission', function (Blueprint $table) {
            $table->foreignId('operator_id')->constrained('operators');
            $table->foreignId('permission_id')->constrained('permissions');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operator_permission');
    }
};
