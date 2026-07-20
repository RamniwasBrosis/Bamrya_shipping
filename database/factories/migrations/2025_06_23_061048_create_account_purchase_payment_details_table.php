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
        Schema::create('account_purchase_payment_details', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('uuid');
            $table->unsignedBigInteger('purchase_id')->nullable();
            $table->foreign('purchase_id')->references('id')->on('account_purchase_payments')->onDelete('set null');
            $table->string('inv_type')->nullable();
            $table->string('inv_no')->nullable();
            $table->string('payment_type')->nullable(); // Full/Part
            $table->string('percentage')->nullable(); // TDS %
            $table->decimal('tds_amount', 10, 2)->nullable();
            $table->decimal('payment_amount', 10, 2)->nullable();
            $table->decimal('actual_amount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_purchase_payment_details');
    }
};
