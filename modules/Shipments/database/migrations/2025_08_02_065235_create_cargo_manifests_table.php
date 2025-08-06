<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cargo_manifests', function (Blueprint $table) {
            $table->id();
            $table->string('transport_code')->unique();
            $table->foreignId('transport_type_id')->constrained();
            $table->enum('status', ['draft', 'scheduled', 'in_transit', 'delivered', 'canceled'])->default('draft');
            $table->json('coordinates');
            $table->decimal('max_weight');
            $table->decimal('extra_handling_fee')->default(0);
            $table->decimal('final_cost');
            $table->timestamp('departure_at')->nullable();
            $table->timestamp('arrival_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cargo_manifests');
    }
};
