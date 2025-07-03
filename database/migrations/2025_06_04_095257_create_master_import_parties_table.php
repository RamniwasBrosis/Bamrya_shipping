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
        Schema::create('master_import_parties', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');
            $table->string('uuid');
            $table->string('party_code', 10);
            $table->string('party_name', 100);
            $table->string('tally_ledger', 100)->nullable();
            $table->string('address_line1', 100)->nullable();
            $table->string('address_line2', 100)->nullable();
            $table->string('address_line3', 100)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('pincode', 6)->nullable();

            $table->unsignedTinyInteger('party_type')->nullable();
            $table->foreign('party_type')->references('id')->on('master_parties')->onDelete('set null');

            $table->string('contact_person', 100)->nullable();
            $table->string('tel_no', 100)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('gstin', 15)->nullable();
            // $table->string('pan_no', 12)->nullable();
            $table->string('cin_no', 25)->nullable();
            $table->string('pan_no', 12)->nullable();
            $table->integer('credit_days')->default(0)->nullable();
            $table->unsignedTinyInteger('tds_percent')->default(0)->nullable(); // 0, 2, or 5
            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_import_parties');
    }
};
