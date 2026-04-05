<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->unique();
            $table->unsignedBigInteger('customer_id')->index();
            $table->unsignedBigInteger('sales_id')->index();
            $table->unsignedBigInteger('car_type_id')->index();

            $table->unsignedBigInteger('price_otr');
            $table->unsignedBigInteger('discount')->default(0);
            $table->unsignedBigInteger('admin_fee')->default(0);
            $table->enum('payment_type', ['Cash','Credit'])->index();
            $table->unsignedBigInteger('down_payment')->nullable();
            $table->unsignedBigInteger('leasing_id')->nullable()->index();
            $table->integer('tenor_months')->nullable();
            $table->unsignedBigInteger('installment_amount')->nullable();

            $table->text('notes')->nullable();
            $table->enum('status', ['Waiting_Approval','Approved','Rejected','Completed'])->default('Waiting_Approval')->index();
            $table->unsignedBigInteger('approved_by')->nullable()->index();
            $table->timestamp('approved_at')->nullable()->index();

            $table->timestamps();
            $table->foreign('customer_id', 'fk_transactions_customer')
                ->references('id')->on('customers')
                ->cascadeOnDelete();
            $table->foreign('sales_id', 'fk_transactions_sales')
                ->references('id')->on('users')
                ->cascadeOnDelete();
            $table->foreign('car_type_id', 'fk_transactions_car_type')
                ->references('id')->on('car_types')
                ->restrictOnDelete();
            $table->foreign('leasing_id', 'fk_transactions_leasing')
                ->references('id')->on('leasings')
                ->nullOnDelete();
            $table->foreign('approved_by', 'fk_transactions_approved_by')
                ->references('id')->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
