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
        Schema::create('operation_sea_imports', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');
            $table->string('uuid');

            $table->enum('bl_issue_by', ['1', '2']);

            $table->unsignedBigInteger('job_no')->nullable();
            $table->foreign('job_no')->references('id')->on('operation_job_masters')->onDelete('set null');
            
            $table->string('cargo_type')->nullable(); // FCL/LCL etc.
            $table->string('mbl_no')->nullable();
            $table->date('mbl_date')->nullable();
            $table->string('hbl_no')->nullable();
            $table->date('hbl_date')->nullable();
            $table->string('igm_no')->nullable();
            $table->date('igm_date')->nullable();
            $table->string('item_no')->nullable();
            $table->string('sub_item_no')->nullable();
            $table->string('voyage_no')->nullable();
            $table->date('arrival_date')->nullable();
            $table->unsignedBigInteger('vessel_id')->nullable();
            $table->date('eta_date')->nullable();
            $table->date('etd_date')->nullable();
            $table->integer('quantity')->nullable();
            
            $table->integer('package_id')->nullable();
            $table->foreign('package_id')->references('id')->on('master_packages')->onDelete('cascade');
            
            $table->enum('freight', ['P', 'C'])->nullable(); // P or C
            $table->decimal('gross_weight', 10, 2)->nullable();
            $table->decimal('cbm', 10, 2)->nullable();
            $table->string('cargo')->nullable(); // LOCAL/SMTP/TP/etc.
            $table->boolean('is_hazardous')->default(false)->nullable();
            $table->string('delivery_type')->nullable();
            $table->string('imo_cd')->nullable();
            $table->string('uno_cd')->nullable();
            $table->integer('free_days')->nullable();
            $table->string('hbl_type')->nullable(); 
            $table->decimal('fpa_amount', 10, 2)->nullable();
            $table->string('transportation_details')->nullable();
            $table->string('bill_of_entry')->nullable();
            $table->date('delivery_order_date')->nullable();

            $table->unsignedBigInteger('loading_port_id')->nullable();
            $table->foreign('loading_port_id')->references('id')->on('master_ports')->onDelete('set null');
            $table->unsignedBigInteger('discharge_port_id')->nullable();
            $table->foreign('discharge_port_id')->references('id')->on('master_ports')->onDelete('set null');
            $table->unsignedBigInteger('delivery_port_id')->nullable();
            $table->foreign('delivery_port_id')->references('id')->on('master_ports')->onDelete('set null');
            $table->unsignedBigInteger('destination_port_id')->nullable();
            $table->foreign('destination_port_id')->references('id')->on('master_ports')->onDelete('set null');

            $table->unsignedBigInteger('shipping_line_id')->nullable();
            $table->foreign('shipping_line_id')->references('id')->on('master_import_parties')->onDelete('set null');
            $table->unsignedBigInteger('overseas_agent_id')->nullable();
            $table->foreign('overseas_agent_id')->references('id')->on('master_import_parties')->onDelete('set null');
            $table->unsignedBigInteger('cfs_yard_id')->nullable();
            $table->foreign('cfs_yard_id')->references('id')->on('master_import_parties')->onDelete('set null');
            $table->unsignedBigInteger('empty_yard_id')->nullable();
            $table->foreign('empty_yard_id')->references('id')->on('master_import_parties')->onDelete('set null');
            $table->unsignedBigInteger('sales_person_id')->nullable();
            $table->foreign('sales_person_id')->references('id')->on('master_import_parties')->onDelete('set null');
            $table->unsignedBigInteger('coloader_id')->nullable();
            $table->foreign('coloader_id')->references('id')->on('master_import_parties')->onDelete('set null');
            $table->unsignedBigInteger('shipper_id')->nullable();
            $table->foreign('shipper_id')->references('id')->on('master_import_parties')->onDelete('set null');
            $table->unsignedBigInteger('consignee_id')->nullable();
            $table->foreign('consignee_id')->references('id')->on('master_import_parties')->onDelete('set null');
            $table->unsignedBigInteger('notify_id')->nullable();
            $table->foreign('notify_id')->references('id')->on('master_import_parties')->onDelete('set null');
            $table->unsignedBigInteger('cha_id')->nullable();
            $table->foreign('cha_id')->references('id')->on('master_import_parties')->onDelete('set null');

            $table->text('mark_and_numbers')->nullable();
            $table->text('goods_description')->nullable();
            $table->string('obl_no')->nullable();
            $table->date('obl_date')->nullable();
            $table->string('ref_no')->nullable();
            $table->date('do_date')->nullable();

            $table->unsignedBigInteger('surveyor_id')->nullable();
            $table->foreign('surveyor_id')->references('id')->on('master_import_parties')->onDelete('set null');

            $table->date('validity_date')->nullable();

            $table->string('enquiry_reference_no')->nullable();
            $table->string('transportation')->nullable();
            $table->string('insurance')->nullable();
            $table->string('clearance')->nullable();
            $table->string('sub_job_no')->nullable();
            $table->string('remarks')->nullable();
            $table->string('username')->nullable();
            $table->string('prealert_date')->nullable();
            $table->string('inv_no_full')->nullable();
            
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_sea_imports');
    }
};
