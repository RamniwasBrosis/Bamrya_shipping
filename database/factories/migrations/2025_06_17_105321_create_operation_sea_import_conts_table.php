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
        Schema::create('operation_sea_import_conts', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');            
            $table->string('uuid');

            $table->unsignedBigInteger('sea_import_id')->nullable();
            $table->foreign('sea_import_id')->references('id')->on('operation_sea_imports')->onDelete('set null');

            $table->string('cont_hbl')->nullable();
            $table->string('container_no', 20)->nullable();
            $table->string('size', 20)->nullable();
            $table->string('seal_no')->nullable();
            $table->decimal('gross_weight', 10, 2)->nullable();
            $table->decimal('cbm', 10, 2)->nullable();
            $table->enum('refer', ['Y', 'N'])->nullable();
            $table->string('fcl_lcl', 10)->nullable();
            $table->integer('total_package')->nullable();
            $table->string('cargo_type')->nullable();
            $table->date('detent_date')->nullable();
            $table->integer('freedays_cont')->nullable();
            $table->date('ground_date')->nullable();
            $table->integer('ground_days')->nullable();
            $table->string('imo_code')->nullable();
            $table->string('uno_no')->nullable();
            $table->string('tp_icd')->nullable();
            $table->string('soc_yn', 1)->nullable();
            $table->string('disposal')->nullable();
            $table->text('remarks')->nullable();
            $table->string('printed')->nullable();
            $table->string('selected')->nullable();
            $table->string('sector')->nullable();
            $table->integer('previous_days')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_sea_import_conts');
    }
};
