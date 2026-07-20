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
        Schema::create('operation_transport_container', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('transport_id');

            $table->foreign('transport_id')
                  ->references('id')
                  ->on('operation_transports')
                  ->onDelete('cascade');

            $table->string('container_no');
            $table->string('vehicle_no')->nullable();
            $table->string('lr_no')->nullable();
            $table->string('cvc_plate')->nullable();
            $table->string('customer_seal_no')->nullable();
            $table->string('net_weight')->nullable();
            $table->string('size');
            $table->string('cont_gross_weight')->nullable();
            $table->string('tare_weight')->nullable();
            $table->string('stuffing_point')->nullable();
            $table->string('agent_seal_no')->nullable();
            $table->string('cargo')->nullable();
            
            $table->unsignedBigInteger('transporter');

            $table->foreign('transporter')
                  ->references('id')
                  ->on('master_import_parties')
                  ->onDelete('cascade');
                  
            $table->string('container_job_no')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_transport_container');
    }
};
