<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('car_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_model_id')->constrained('car_models')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('transmission', ['MT', 'AT', 'CVT']);
            $table->unsignedBigInteger('price_otr');
            $table->json('specifications');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Individual indexes
            $table->index(['car_model_id']);
            $table->index(['transmission']);
            $table->index(['price_otr']);
            $table->index(['is_active']);
            
            // Composite indexes
            $table->index(['is_active', 'transmission'], 'index_active_transmission');
            $table->index(['is_active', 'price_otr'], 'index_active_price');
            $table->index(['transmission', 'price_otr'], 'index_transmission_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_types');
    }
};
