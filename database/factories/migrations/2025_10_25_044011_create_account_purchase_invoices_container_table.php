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
        Schema::create('account_purchase_invoices_container', function (Blueprint $table) {
            $table->id();
            
            $table->integer('company_id');
            $table->string('uuid');
            
            $table->unsignedBigInteger('charge_id')->nullable();
            $table->foreign('charge_id')->references('id')->on('master_charges')->onDelete('set null');
            $table->decimal('gst', 5, 2)->default(0)->nullable();
            $table->string('currency', 10)->nullable();
            $table->enum('prepaid_coll', ['P', 'C'])->default('P')->nullable();
            $table->string('rate_basis')->nullable();
            $table->enum('gst_applicable', ['Y', 'N'])->default('N')->nullable();
            $table->decimal('per_unit', 10, 2)->default(0)->nullable();
            $table->decimal('exchange_rate', 10, 2)->default(0)->nullable();
            $table->decimal('rate_per_unit', 10, 2)->default(0)->nullable();
            $table->decimal('freight', 10, 2)->default(0)->nullable();
            $table->decimal('amount', 10, 2)->default(0)->nullable();
            $table->string('tds')->nullable();
            $table->string('tds_amount')->nullable();
            $table->string('remarks')->nullable();
            
            $table->decimal('caf_percent', 5, 2)->default(0)->nullable();
            $table->decimal('caf_amount', 10, 2)->default(0)->nullable();
            $table->decimal('baf_percent', 5, 2)->default(0)->nullable();
            $table->decimal('baf_amount', 10, 2)->default(0)->nullable();
            $table->decimal('cc_percent', 5, 2)->default(0)->nullable();
            $table->decimal('cc_amount', 10, 2)->default(0)->nullable();
            $table->enum('cc_apply', ['Y', 'N'])->default('N')->nullable();
            $table->enum('caf_apply', ['Y', 'N'])->default('N')->nullable();
            $table->string('gstin')->nullable();
            $table->string('sac_code')->nullable();
            $table->decimal('cgst', 10, 2)->default(0)->nullable();
            $table->decimal('sgst', 10, 2)->default(0)->nullable();
            $table->decimal('igst', 10, 2)->default(0)->nullable();
            $table->decimal('total', 10, 2)->default(0)->nullable();
            
            $table->unsignedBigInteger('purchase_invoice_id')->nullable();
            $table->foreign('purchase_invoice_id')->references('id')->on('account_purchase_invoices')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_purchase_invoices_container');
    }
};
