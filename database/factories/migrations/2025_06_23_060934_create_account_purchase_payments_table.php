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
        Schema::create('account_purchase_payments', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');
            $table->string('uuid');

            $table->unsignedBigInteger('billing_party_id')->nullable();
            $table->foreign('billing_party_id')->references('id')->on('master_import_parties')->onDelete('set null');
            $table->string('invoice_f_year')->nullable();
            $table->date('pp_date')->nullable();

            $table->enum('radio_type', ['neft_cash', 'onaccount']);

            $table->string('neft_details')->nullable();
            $table->date('neft_date')->nullable();
            $table->string('bank_name')->nullable();
            $table->decimal('total_amount_payable', 12, 2)->default(0)->nullable();
            $table->string('billing_party')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_purchase_payments');
    }
};
