<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->nullable()->constrained('leads')->nullOnDelete()->index();
            $table->string('nik', 16)->unique();
            $table->string('name')->index();
            $table->enum('gender', ['L','P'])->index();
            $table->string('phone')->index();
            $table->string('email')->nullable()->index();
            $table->text('address')->nullable();
            $table->string('city')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
