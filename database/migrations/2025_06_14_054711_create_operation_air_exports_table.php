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
        Schema::create('operation_air_exports', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');
            $table->string('uuid');

            $table->unsignedBigInteger('job_no')->nullable();
            $table->foreign('job_no')->references('id')->on('operation_job_masters')->onDelete('set null');
            $table->string('full_job_no')->nullable();
            $table->string('booking_no')->nullable();
            $table->date('booking_date')->nullable();
            $table->string('mawb_no')->nullable();
            $table->string('hawb_no')->nullable();
            $table->date('eta_date')->nullable();
            $table->date('etd_date')->nullable();
            $table->string('enquiry_reference_no')->nullable();
            $table->string('flight_name_1')->nullable();
            $table->date('flight_date_1')->nullable();
            $table->string('flight_number_1')->nullable();
            $table->string('flight_name_2')->nullable();
            $table->date('flight_date_2')->nullable();
            $table->string('flight_number_2')->nullable();
            $table->decimal('gross_weight', 10, 2)->default(0)->nullable();
            $table->decimal('chargable_weight', 10, 2)->default(0)->nullable();
            $table->decimal('tare_weight', 10, 2)->default(0)->nullable();
            $table->string('issue_place')->nullable();
            $table->string('movement')->nullable();
            $table->string('iata_agent')->nullable();
            $table->integer('package')->default(0);
            $table->integer('package_id')->nullable();
            $table->foreign('package_id')->references('id')->on('master_packages')->onDelete('cascade');
            $table->string('customer_acc_no')->nullable();
            $table->date('issue_date')->nullable();
            $table->unsignedBigInteger('sales_person_id')->nullable();

            // Party Details
            $table->unsignedBigInteger('shipper_id')->nullable();
            $table->foreign('shipper_id')->references('id')->on('master_import_parties')->onDelete('set null');
            $table->unsignedBigInteger('consignee_id')->nullable();
            $table->foreign('consignee_id')->references('id')->on('master_import_parties')->onDelete('set null');
            $table->unsignedBigInteger('lata_agent')->nullable();
            $table->foreign('lata_agent')->references('id')->on('master_import_parties')->onDelete('set null');
            $table->unsignedBigInteger('overSeas_agent')->nullable();
            $table->foreign('overSeas_agent')->references('id')->on('master_import_parties')->onDelete('set null');

            // Port Details
            $table->unsignedBigInteger('loading_port_id')->nullable();
            $table->foreign('loading_port_id')->references('id')->on('master_ports')->onDelete('set null');
            $table->unsignedBigInteger('discharge_port_id')->nullable();
            $table->foreign('discharge_port_id')->references('id')->on('master_ports')->onDelete('set null');
            $table->unsignedBigInteger('receipt_port_id')->nullable();
            $table->foreign('receipt_port_id')->references('id')->on('master_ports')->onDelete('set null');
            $table->unsignedBigInteger('delivery_port_id')->nullable();
            $table->foreign('delivery_port_id')->references('id')->on('master_ports')->onDelete('set null');

            $table->string('insurance')->nullable();
            $table->decimal('fpa_amount', 10, 2)->nullable();
            $table->string('transportation')->nullable();
            $table->text('transportation_details')->nullable();
            $table->string('clearance')->nullable();
            $table->string('shipping_bill')->nullable();

            // Other Fields
            $table->text('mark_number')->nullable();
            $table->text('goods_description')->nullable();
            $table->text('handling_information')->nullable();
            $table->text('dimention')->nullable();

            // file upload
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
        Schema::dropIfExists('operation_air_exports');
    }
};
