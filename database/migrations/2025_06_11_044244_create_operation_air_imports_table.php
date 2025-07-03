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
        Schema::create('operation_air_imports', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');
            $table->string('uuid')->nullable();
        
            $table->string('mawb_no', 35)->nullable();
            $table->date('mawb_date')->nullable();
            $table->string('flight_no')->nullable();
            $table->date('flight_date')->nullable();
            $table->string('igm_no')->nullable();
            $table->date('igm_date')->nullable();
            $table->string('origin_port')->nullable();
            $table->string('dest_port')->nullable();
            $table->string('shipment')->nullable(); // TOTAL, PART, SPLIT
            $table->string('package')->nullable();
            $table->decimal('weight', 10, 2)->default(0)->nullable();
            $table->string('username')->nullable();
            $table->string('description')->nullable()->default('CONSOLIDATION');
            $table->string('remark')->nullable();
            $table->string('full_job_no')->nullable();
            $table->date('eta_date')->nullable();
            $table->date('etd_date')->nullable();

            $table->unsignedBigInteger('job_no')->nullable();
            $table->string('hbl_no')->nullable();
            $table->date('hbl_date')->nullable();
            $table->string('hawb_origin_port')->nullable();
            $table->string('hawb_dest_port')->nullable();
            $table->string('hawb_shipment')->nullable();
            $table->string('hawb_package')->nullable();
            $table->decimal('hawb_weight', 10, 2)->default(0);
            $table->string('enquiry_reference_no')->nullable();
            $table->text('descriptions')->nullable();

            $table->string('freight')->nullable();
            $table->string('currency')->nullable();
            $table->decimal('exchange_rate', 10, 2)->default(0);
            $table->decimal('cc_perc', 10, 2)->default(0);
            $table->string('cc_currency')->nullable();
            $table->decimal('cc_exch_rate', 10, 2)->default(0);
            $table->decimal('caf_perc', 10, 2)->default(0);
            $table->decimal('chg_weight', 10, 2)->default(0);

            $table->unsignedBigInteger('consignee_id')->nullable();
            $table->unsignedBigInteger('shipper_id')->nullable();
            $table->unsignedBigInteger('billing_party_id')->nullable();
            $table->unsignedBigInteger('sales_person_id')->nullable();

            $table->decimal('fpa_amount', 10, 2)->nullable();
            $table->string('bill_of_entry')->nullable();
            $table->string('insurance')->nullable();
            $table->string('transportation')->nullable();
            $table->string('transportation_details')->nullable();
            $table->string('clearance')->nullable();

            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_air_imports');
    }
};
