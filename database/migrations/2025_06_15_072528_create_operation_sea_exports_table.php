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
        Schema::create('operation_sea_exports', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');
            $table->string('uuid');
            $table->enum('entry_by', ['Packinglist', 'nominated']);

            $table->unsignedBigInteger('job_no')->nullable();
            $table->foreign('job_no')->references('id')->on('operation_job_masters')->onDelete('set null');

            $table->string('full_job_no')->nullable();
            $table->string('booking_no')->nullable();
            $table->date('booking_date')->nullable();
            $table->unsignedBigInteger('vessel_id')->nullable();
            $table->string('voyage_no')->nullable();
            $table->string('mbl_no')->nullable();
            $table->string('hbl_no')->nullable();
            $table->string('enquiry_ref_no')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('package_id')->nullable();
            $table->foreign('package_id')->references('id')->on('master_packages')->onDelete('cascade');
            $table->string('freight')->nullable();
            $table->decimal('freight_charges', 10, 2)->nullable();
            $table->decimal('gross_weight', 10, 2)->nullable();
            $table->decimal('net_weight', 10, 2)->nullable();
            $table->decimal('tare_weight', 10, 2)->nullable();
            $table->string('volume_unit')->nullable();
            $table->string('movement')->nullable();
            $table->string('cargo_type')->nullable();
            $table->date('eta_date')->nullable();
            $table->date('etd_date')->nullable();
            $table->decimal('cbm', 10, 2)->nullable();
            $table->date('sob_date')->nullable();
            $table->string('port_cutoff')->nullable();
            $table->string('si_cutoff')->nullable();
            $table->string('document_cutoff')->nullable();
            $table->string('vgm_cutoff')->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('overseas_agent_id')->nullable();
            $table->string('bl_type')->nullable();
            $table->string('issue_place')->nullable();
            $table->integer('no_of_origin')->nullable();
            $table->string('place_of_acceptance')->nullable();
            $table->unsignedBigInteger('sales_person_id')->nullable();
            $table->string('stuffing_point')->nullable();
            $table->unsignedBigInteger('cha_id')->nullable();
            $table->unsignedBigInteger('shipping_line_id')->nullable();
            $table->unsignedBigInteger('forwarder_id')->nullable();
            $table->date('bl_issued_date')->nullable();
            $table->date('vgm_issued_date')->nullable();

                // Party Details
                $table->unsignedBigInteger('shipper_id')->nullable();
                $table->foreign('shipper_id')->references('id')->on('master_import_parties')->onDelete('set null');
                $table->unsignedBigInteger('consignee_id')->nullable();
                $table->foreign('consignee_id')->references('id')->on('master_import_parties')->onDelete('set null');
                $table->unsignedBigInteger('notify_id')->nullable();
                $table->foreign('notify_id')->references('id')->on('master_import_parties')->onDelete('set null');
                $table->unsignedBigInteger('notify2_id')->nullable();
                $table->foreign('notify2_id')->references('id')->on('master_import_parties')->onDelete('set null');

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
                $table->text('customer_inv_no')->nullable();
                $table->text('sbill_no')->nullable();
                $table->text('commodity')->nullable();
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_sea_exports');
    }
};
