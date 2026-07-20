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
        Schema::create('master_ports', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');
            $table->string('uuid');
            $table->string('port_code', 100)->nullable();
            $table->string('port_name', 100)->nullable();
            $table->string('edi_code', 100)->nullable();
            $table->string('jnpt_code', 100)->nullable();
            $table->string('nsict_code', 100)->nullable();
            $table->string('nsict_group_code', 100)->nullable();
            $table->string('gti_code', 100)->nullable();
            $table->string('gti_group_code', 100)->nullable();
            $table->string('nsi_gt_code', 100)->nullable();
            $table->tinyInteger('status')->default(1);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_ports');
    }
};
