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
        Schema::create('operation_export_bl_containers', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');
            $table->string('booking_no');

            $table->string('cont_hbl')->nullable();
            $table->string('container_no')->nullable();
            $table->string('size')->nullable();
            $table->string('cust_seal_no')->nullable();
            $table->decimal('gross_weight', 10, 2)->nullable();
            $table->decimal('cbm', 10, 2)->nullable();
            $table->string('refer')->nullable();
            $table->string('fcl_lcl')->nullable();
            $table->integer('total_package')->nullable();
            $table->string('cargo_type')->nullable();
            $table->string('agent_seal_no')->nullable();
            $table->decimal('net_weight', 10, 2)->nullable();
            $table->date('ground_date')->nullable();
            $table->decimal('vgm_weight', 10, 2)->nullable();
            $table->string('imo_code')->nullable();
            $table->string('uno_no')->nullable();
            $table->string('temperature')->nullable();
            $table->string('soc')->nullable();
            $table->string('disposal')->nullable();
            $table->date('detention_date')->nullable();
            $table->string('remarks')->nullable();
            $table->string('commodity')->nullable();
            $table->string('sector')->nullable();
            $table->integer('previous_days')->nullable();
            $table->string('cont_job_no')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_export_bl_containers');
    }
};
