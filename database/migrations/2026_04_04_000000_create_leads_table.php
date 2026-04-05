<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('lead_code')->unique()->index();
            $table->foreignId('car_type_id')->nullable()->constrained('car_types')->nullOnDelete();
            $table->string('customer_name');
            $table->string('phone')->index();
            $table->string('source')->default('offer_modal');
            $table->string('channel')->nullable();
            $table->enum('status', ['New','Assigned','Follow_Up','Negotiation','Won','Lost'])->default('New')->index();
            $table->text('notes')->nullable();
            $table->foreignId('sales_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('submitted_at')->useCurrent();
            $table->string('otp_id')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
