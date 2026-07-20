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
        Schema::create('master_charges', function (Blueprint $table) {
            $table->id();

            $table->string('company_id');
            $table->string('uuid');
            $table->string('charge_code');
            $table->string('charge_name');
            $table->string('tally_ledger_name');
            $table->enum('currency', ['INR', 'USD', 'OTH'])->default('INR');
            $table->enum('charge_type', ['Freight', 'Normal'])->default('Freight');
            $table->boolean('gst_applicable')->default(true); // 1 = Y, 0 = N
            $table->integer('gst_percentage')->default(0);
            $table->boolean('has_formula')->default(false); // 1 = Y, 0 = N
            $table->decimal('limit', 10, 2)->nullable();
            $table->decimal('percentage', 5, 2)->nullable();
            $table->string('sac_code')->default('0');
            $table->boolean('status')->default(true); // 1 = Active, 0 = In-Active

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_charges');
    }
};
