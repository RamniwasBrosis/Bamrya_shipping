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
        Schema::create('account_proforma_invoices', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');
            $table->string('uuid');
            $table->string('inv_cat')->nullable();

            $table->string('job_no');
            $table->string('voyage_code')->nullable();
            $table->string('pod')->nullable();
            $table->string('container')->nullable();
            $table->string('consignee')->nullable();
            $table->string('cbm')->nullable();
            $table->string('gross_weight')->nullable();
            $table->string('chargeable_weight')->nullable();

            $table->enum('party_type', ['customer', 'other']); 
            $table->unsignedBigInteger('billing_party_id');
            $table->foreign('billing_party_id')->references('id')->on('master_import_parties')->onDelete('cascade');
            $table->string('invoice_no')->nullable();
            $table->string('invoice_type')->nullable();
            $table->enum('gst_type', ['local', 'outstation'])->nullable();
            $table->date('invoice_date');
            $table->unsignedBigInteger('bank_id');
            $table->foreign('bank_id')->references('id')->on('master_banks')->onDelete('cascade');


            //Charges            
            $table->string('charge_name')->nullable();
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



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_proforma_invoices');
    }
};
