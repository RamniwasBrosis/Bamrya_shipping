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
        Schema::create('account_payment_amounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id');
            $table->string('uuid', 255);
            $table->unsignedBigInteger('party_id')->nullable();
            $table->date('sales_date');
            $table->decimal('amount', 10, 2);
            $table->decimal('round_of_amount', 10, 2)->nullable();
            $table->integer('bank_id')->nullable();
            $table->timestamps();
    
            // If party table exists
            $table->foreign('party_id')->references('id')->on('master_import_parties')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_payment_amounts');
    }
};
