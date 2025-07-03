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
        Schema::create('operation_transports', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('company_id');
            $table->string('uuid'); 
            
            // $table->string('detail_type'); 
            
            $table->string('job_no')->nullable();
            $table->string('full_job_no')->nullable();

            $table->unsignedBigInteger('from_party_id')->nullable();
            $table->foreign('from_party_id')->references('id')->on('master_import_parties')->onDelete('set null');

            $table->unsignedBigInteger('cha_trans_id')->nullable();
            $table->foreign('cha_trans_id')->references('id')->on('master_import_parties')->onDelete('set null');

            $table->unsignedBigInteger('from_place_id')->nullable();
            $table->foreign('from_place_id')->references('id')->on('master_ports')->onDelete('set null');

            $table->unsignedBigInteger('to_place_id')->nullable();
            $table->foreign('to_place_id')->references('id')->on('master_ports')->onDelete('set null');

            $table->string('booking_no')->nullable();
            $table->string('customer_inv_no')->nullable();
            $table->date('booking_date')->nullable();
            $table->date('ccm_date')->nullable();
            $table->date('pickup_date')->nullable();
            $table->date('stuffing_date')->nullable();
            $table->date('gate_in_date')->nullable();
            $table->date('port_in_date')->nullable();

            $table->unsignedBigInteger('sales_person_id')->nullable();
            $table->foreign('sales_person_id')->references('id')->on('master_import_parties')->onDelete('set null');

            $table->unsignedBigInteger('transporter_id')->nullable();
            $table->foreign('transporter_id')->references('id')->on('master_import_parties')->onDelete('set null');

            $table->string('shipping_bill_no')->nullable();
            $table->string('description')->nullable();
            $table->integer('quantity')->nullable();

            $table->integer('package_id')->nullable();
            $table->foreign('package_id')->references('id')->on('master_packages')->onDelete('cascade');
            $table->decimal('gross_weight', 10, 2)->nullable();
            $table->text('remarks')->nullable();


            $table->string('container_no', 11)->nullable();
            $table->string('size', 10)->nullable();
            $table->string('vehicle_no', 20)->nullable();
            $table->string('lr_no')->nullable();
            $table->decimal('tare_weight', 10, 2)->nullable()->default(0);     
            $table->decimal('cont_gross_weight', 10, 2)->nullable()->default(0);     
            $table->string('cvc_plate')->nullable();
            $table->string('stuffing_point')->nullable();
            $table->string('customer_seal_no')->nullable();
            $table->string('agent_seal_no')->nullable();
            $table->decimal('net_weight', 10, 2)->nullable();
            $table->string('cargo')->nullable();
            $table->string('container_job_no')->nullable();
            $table->unsignedBigInteger('cont_transporter_id')->nullable();
            $table->foreign('cont_transporter_id')->references('id')->on('master_import_parties')->onDelete('set null');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_transports');
    }
};
