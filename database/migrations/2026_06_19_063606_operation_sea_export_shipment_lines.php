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
        Schema::create('operation_sea_export_shipment_lines', function (Blueprint $table) {

            $table->id();

            $table->uuid('uuid')->nullable();

            $table->unsignedBigInteger('company_id');

            $table->unsignedBigInteger('sea_export_id');

            $table->unsignedBigInteger('sea_export_cont_id')->nullable();

            $table->unsignedBigInteger('consignee_id');

            $table->string('invoice_no')->nullable();
            $table->date('invoice_date')->nullable();

            $table->string('shipping_bill_no')->nullable();
            $table->date('shipping_bill_date')->nullable();

            $table->date('leo_date')->nullable();
            $table->date('carting_date')->nullable();
            $table->date('check_list_date')->nullable();

            $table->integer('packages')->nullable();

            $table->decimal('gross_weight',12,3)->nullable();
            $table->decimal('cbm',12,3)->nullable();

            $table->text('goods_description')->nullable();

            $table->text('mark_number')->nullable();

            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_sea_export_shipment_lines');
    }
};
