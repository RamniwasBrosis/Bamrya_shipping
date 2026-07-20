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
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id')->nullable();
            // $table->string('company_name', 200);
            // $table->string('company_email', 200);
            $table->string('reg_no', 50)->nullable();
            $table->string('icegate_no', 50)->nullable();
            $table->string('branches', 70)->nullable();
            $table->string('carn_no', 15)->nullable();
            $table->string('mlo_code', 10)->nullable();
            $table->string('jnpt_code', 5)->nullable();
            $table->string('gti_code', 5)->nullable();
            $table->string('nsict_code', 5)->nullable();
            $table->string('nsgit_code', 5)->nullable();
            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};
