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
        Schema::create('operation_bookings', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');
            $table->string('uuid');

            // general details
            $table->string('booking_no');
            $table->unsignedBigInteger('vessel_id')->nullable();
            $table->string('voy_no')->nullable();

            // cargo details
            $table->date('eta_date')->nullable();
            $table->date('entry_date')->nullable();
            $table->integer('validity_days')->nullable();
            $table->date('validity_date')->nullable();

            // Overseas Agent Details
            $table->string('cargo_type')->nullable();
            $table->string('shipment_terms')->nullable();
            $table->string('gate_open')->nullable();
            $table->string('container_volume')->nullable();
            $table->string('plugging')->nullable();
            $table->boolean('do_cancel')->default(false)->nullable();
            $table->string('cargo_wt')->nullable();
            $table->string('cont_wt')->nullable();
            $table->string('ventilation')->nullable();
            $table->string('temperature')->nullable();
            $table->string('commodity')->nullable();
            $table->string('package')->nullable();
            $table->text('humidity')->nullable();
            $table->text('special_eq_remarks')->nullable();
            $table->string('class')->nullable();
            $table->string('sub_class')->nullable();

            // Party Details
            $table->unsignedBigInteger('shipper_id')->nullable();
            $table->unsignedBigInteger('sales_person_id')->nullable();
            $table->unsignedBigInteger('empty_yard_id')->nullable();
            $table->unsignedBigInteger('surveyor_id')->nullable();
            $table->unsignedBigInteger('shipping_line_id')->nullable();

            // Port Details
            $table->unsignedBigInteger('port_loading_id')->nullable();
            $table->unsignedBigInteger('port_discharge_id')->nullable();
            $table->unsignedBigInteger('port_transhipment_id')->nullable();
            $table->unsignedBigInteger('port_destination_id')->nullable();

            // Other details
            $table->text('imo_cd')->nullable();
            $table->text('uno_cd')->nullable();
            $table->text('cancel_remark')->nullable();
            $table->text('special_remark')->nullable();
            $table->string('full_do_no')->nullable();

            $table->foreign('vessel_id')->references('id')->on('master_vessels')->onDelete('set null');

            $table->foreign('shipper_id')->references('id')->on('master_import_parties')->onDelete('set null');
            $table->foreign('sales_person_id')->references('id')->on('master_import_parties')->onDelete('set null');
            $table->foreign('empty_yard_id')->references('id')->on('master_import_parties')->onDelete('set null');
            $table->foreign('surveyor_id')->references('id')->on('master_import_parties')->onDelete('set null');
            $table->foreign('shipping_line_id')->references('id')->on('master_import_parties')->onDelete('set null');

            $table->foreign('port_loading_id')->references('id')->on('master_ports')->onDelete('set null');
            $table->foreign('port_discharge_id')->references('id')->on('master_ports')->onDelete('set null');
            $table->foreign('port_transhipment_id')->references('id')->on('master_ports')->onDelete('set null');
            $table->foreign('port_destination_id')->references('id')->on('master_ports')->onDelete('set null');

            // Container Details (embedded in bookings table)
            $table->string('cont_category', 10)->nullable();         
            $table->string('container_no', 20)->nullable();          
            $table->string('size', 20)->nullable();                  
            $table->string('customer_seal_no', 20)->nullable();     
            $table->string('cont_do_no', 20)->nullable();            

            // For storing file name or full path
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
        Schema::dropIfExists('operation_bookings');
    }
};
