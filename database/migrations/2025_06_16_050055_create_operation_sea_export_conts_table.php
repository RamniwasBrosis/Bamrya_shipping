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
        Schema::create('operation_sea_export_conts', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');
            $table->string('uuid');
            $table->unsignedBigInteger('sea_export_id')->nullable();
            $table->foreign('sea_export_id')->references('id')->on('operation_sea_exports')->onDelete('set null');


            $table->string('cont_hbl');
            $table->string('gross_weight')->nullable();
            $table->string('total_package')->nullable();
            $table->date('ground_date')->nullable();
            $table->string('temp')->nullable();
            $table->string('remarks')->nullable();
            $table->string('cont_job_no')->nullable();
            $table->string('container_no');
            $table->string('cbm')->nullable();
            $table->string('cargo_type')->nullable();
            $table->string('vgm_wt')->nullable();
            $table->string('soc')->nullable();
            $table->string('commodity')->nullable();
            $table->string('size')->nullable();
            $table->string('refer')->nullable();
            $table->string('agent_seal_no')->nullable();
            $table->string('imo_code')->nullable();
            $table->string('disposal')->nullable();
            $table->string('sector')->nullable();
            $table->string('cust_seal_no')->nullable();
            $table->string('fcl_lcl')->nullable();
            $table->string('net_weight')->nullable();
            $table->string('uno_no')->nullable();
            $table->date('detent_date')->nullable();
            $table->string('prev_days')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_sea_export_conts');
    }
};
