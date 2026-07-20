<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('operation_enquiries', function (Blueprint $table) {
            $table->id();

            /* =========================
             * BASIC ENQUIRY (FORM 1)
             * ========================= */ 
            $table->string('reference_id')->nullable();

            $table->unsignedBigInteger('discharge_port_id')->nullable();
            $table->foreign('discharge_port_id')->references('id')->on('master_ports')->onDelete('set null');
            
            $table->unsignedBigInteger('loading_port_id')->nullable();
            $table->foreign('loading_port_id')->references('id')->on('master_ports')->onDelete('set null');
            
            $table->unsignedBigInteger('consignee_id')->nullable();
            $table->foreign('consignee_id')->references('id')->on('master_import_parties')->onDelete('set null');
            
            $table->unsignedBigInteger('sales_person_id')->nullable();
            $table->foreign('sales_person_id')->references('id')->on('operation_sales_people')->onDelete('set null');
            
            $table->string('inco_terms')->nullable();

            $table->string('gross_weight')->nullable();
            $table->string('chargeable_weight')->nullable();
            $table->string('no_of_pkgs')->nullable();
            $table->string('no_of_container')->nullable();
            $table->string('cbm')->nullable();

            $table->string('buying_rate')->nullable();
            $table->string('selling_rate')->nullable();

            $table->string('shipment_type')->nullable();
            $table->string('lcl_fcl')->nullable();
            $table->string('kgs_mts')->nullable();

            $table->string('eta_etd')->nullable();
            $table->date('enquiry_date')->nullable();

            $table->string('contact_details')->nullable();
            $table->string('commodity_desc')->nullable();

            $table->string('enquiry_status')->nullable();

            $table->text('follow_up')->nullable();
            $table->text('lost_enquiry_remarks')->nullable();

            /* =========================
             * CBM CALCULATOR (FORM 2)
             * ========================= */
            $table->string('enquiry_no');          // required
            $table->decimal('length', 10, 2)->nullable();
            $table->decimal('width', 10, 2)->nullable();
            $table->decimal('height', 10, 2)->nullable();
            $table->integer('quantity')->nullable();

            $table->decimal('total_cbm', 10, 3)->nullable();
            $table->decimal('total_chg_wt', 10, 3)->nullable();

            /* =========================
             * SELLING SUMMARY
             * ========================= */
            $table->decimal('total_selling_rate')->nullable();
            $table->decimal('total_buy_rate')->nullable();
            $table->decimal('estimated_profit')->nullable();

            /* =========================
             * SELLING other details
             * ========================= */
            $table->string('selling_ref_id_enquiry')->nullable();
            $table->date('selling_from_valid_dt')->nullable();
            $table->date('selling_to_valid_date')->nullable();
            $table->string('selling_activity')->nullable();
            
            $table->unsignedBigInteger('shipping_line_id')->nullable();
            $table->foreign('shipping_line_id')->references('id')->on('master_shippings')->onDelete('set null');
            
            /* =========================
             * SELLING CONTAINER
             * ========================= */
            $table->boolean('selling_lcl')->default(false);
            $table->boolean('selling_fcl_20')->default(false);
            $table->boolean('selling_fcl_40')->default(false);
            $table->boolean('selling_air')->default(false);

            // Container & tax details
            $table->string('selling_container_type')->nullable();
            $table->date('selling_free_days')->nullable();

            $table->string('selling_gstin')->nullable();
            $table->string('selling_sac_code')->nullable();

            $table->decimal('container_cgst', 10, 2)->nullable();
            $table->decimal('container_sgst', 10, 2)->nullable();
            $table->decimal('container_igst', 10, 2)->nullable();
            $table->decimal('container_total', 10, 2)->nullable();
            /* =========================
             * SELLING Charges
             * ========================= */
             // Charge reference
            $table->unsignedBigInteger('selling_charge_id')->nullable();
            $table->foreign('selling_charge_id')->references('id')->on('master_charges')->onDelete('set null');

            // Rate details
            $table->string('selling_currency', 10)->nullable();
            $table->string('selling_rate_basis')->nullable();
            $table->string('selling_origin_dest')->nullable();

            $table->decimal('selling_exchange_rate', 10, 4)->default(1);

            $table->decimal('selling_freight', 12, 2)->nullable();
            $table->decimal('selling_per_unit', 12, 2)->nullable();
            $table->decimal('selling_total_unit', 12, 2)->nullable();

            // GST details
            $table->string('selling_gstin_charge')->nullable();
            $table->string('selling_sac_code_charge')->nullable();
            $table->decimal('selling_gst', 5, 2)->nullable();

            $table->enum('selling_gst_applicable', ['Y', 'N'])->default('Y');

            $table->decimal('selling_cgst', 12, 2)->nullable();
            $table->decimal('selling_sgst', 12, 2)->nullable();
            $table->decimal('selling_igst', 12, 2)->nullable();

            $table->decimal('selling_total', 14, 2)->nullable();
            
            
            /* =========================
             * BUY other details
             * ========================= */
            
            $table->string('buy_ref_id_enquiry')->nullable();
            $table->date('buy_from_valid_dt')->nullable();
            $table->date('buy_to_valid_date')->nullable();
            $table->string('buy_vendor')->nullable();
            $table->string('buy_activity')->nullable();

            // Container Size & Type (checkboxes)
            $table->boolean('buy_lcl')->default(false);
            $table->boolean('buy_fcl20')->default(false);
            $table->boolean('buy_fcl40')->default(false);
            $table->boolean('buy_air')->default(false);

            // Container & tax details
            $table->string('buy_container')->nullable();
            $table->date('buy_free_days')->nullable();

            $table->string('buy_gstin')->nullable();

            $table->decimal('buy_cgst', 12, 2)->nullable();
            $table->decimal('buy_sgst', 12, 2)->nullable();
            $table->decimal('buy_igst', 12, 2)->nullable();
            $table->decimal('buy_total', 14, 2)->nullable();
            
            /* =========================
             * BUY CHARGES
             * ========================= */
            // Charge reference
            $table->unsignedBigInteger('buy_charge_id')->nullable();
            $table->foreign('buy_charge_id')->references('id')->on('master_charges')->onDelete('set null');

            // Rate configuration
            $table->string('buy_currency', 10)->nullable();
            $table->string('buy_rate_basic')->nullable();
            $table->string('buy_origin_dest')->nullable();

            $table->decimal('buy_exchange_rate', 10, 4)->nullable();
            $table->decimal('buy_freight', 12, 2)->nullable();

            // Tax & codes
            $table->string('buy_sac_code')->nullable();
            $table->decimal('buy_gst', 5, 2)->nullable();
            $table->enum('buy_gst_y_n', ['Y', 'N'])->default('Y');

            // Other details
            $table->string('buy_prep_coll')->nullable();
            
            $table->decimal('buy_per_unit', 12, 2)->nullable();
            $table->decimal('buy_rate', 12, 2)->nullable();
            $table->decimal('buy_amount', 14, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operation_enquiries');
    }
};
