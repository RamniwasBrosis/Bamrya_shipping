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
        Schema::create('master_container_sizes', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');
            $table->string('uuid');
            $table->string('cont_type', 200);
            $table->string('description', 200)->nullable();
            $table->string('iso_code', 50)->nullable();
            $table->boolean('status')->default(1); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_container_sizes');
    }
};
