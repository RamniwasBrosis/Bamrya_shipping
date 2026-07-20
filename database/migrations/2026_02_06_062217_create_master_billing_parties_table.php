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
        Schema::create('master_billing_parties', function (Blueprint $table) {
            $table->bigIncrements('id'); // bigint unsigned AUTO_INCREMENT (PK)

            $table->integer('company_id');

            $table->uuid('uuid'); // varchar(100) equivalent, uuid is better

            $table->string('party_code', 25)->nullable();

            $table->string('party_name', 255);

            $table->string('tally_ledger', 100)->nullable();

            $table->string('address_line1', 255)->nullable();
            $table->string('address_line2', 255)->nullable();
            $table->string('address_line3', 255)->nullable();

            $table->string('city', 50)->nullable();
            $table->string('pincode', 50)->nullable();

            $table->tinyInteger('party_type')->unsigned()->nullable();
            // Example usage: 1 = Import, 2 = Export, etc.

            $table->string('contact_person', 100)->nullable();
            $table->string('tel_no', 100)->nullable();
            $table->string('email', 50)->nullable();

            $table->string('gstin', 150)->nullable();
            $table->string('cin_no', 50)->nullable();
            $table->string('pan_no', 50)->nullable();

            $table->integer('credit_days')->default(0)->nullable();
            $table->tinyInteger('tds_percent')->unsigned()->default(0)->nullable();

            $table->json('document')->nullable();

            $table->tinyInteger('approval')->nullable();

            $table->string('party_mode', 25)->nullable();

            $table->tinyInteger('status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_billing_parties');
    }
};
