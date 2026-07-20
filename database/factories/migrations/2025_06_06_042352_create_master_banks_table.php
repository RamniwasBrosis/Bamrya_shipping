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
        Schema::create('master_banks', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');
            $table->string('uuid');
            $table->string('bank_name', 100);
            $table->string('beneficiary_name', 150);
            $table->string('branch_name', 150);
            $table->string('account_no', 50);
            $table->string('ifsc_code', 150);
            $table->string('account_type', 50);
            $table->string('swift_code', 50)->nullable();
            $table->string('gstin_no_company', 50)->nullable();
            $table->string('company_pan', 50)->nullable();
            $table->string('company_name', 150)->nullable();
            $table->text('branch_company_address1')->nullable();
            $table->text('branch_company_address2')->nullable();
            $table->text('branch_company_address3')->nullable();
            $table->string('contact_no', 50)->nullable();
            $table->text('notes1')->nullable();
            $table->text('notes2')->nullable();
            $table->text('notes3')->nullable();
            $table->text('notes4')->nullable();
            $table->text('notes5')->nullable();
            $table->text('notes6')->nullable();
            $table->text('notes7')->nullable();
            $table->text('notes8')->nullable();
            $table->text('notes9')->nullable();
            $table->text('notes10')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_banks');
    }
};
