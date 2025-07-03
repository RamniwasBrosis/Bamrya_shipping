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
        Schema::create('operation_job_masters', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');

            // General Job Info
            $table->string('issued_by')->nullable(); // 1=Nominated, 2=Enquiry
            $table->string('job_no')->nullable();    // Disabled input
            $table->date('job_date')->nullable();
            $table->string('job_activity')->nullable(); // e.g. SEAIMP.FWD
            $table->unsignedBigInteger('job_party_id')->nullable();
            $table->text('job_remarks')->nullable();
            $table->string('term', 10)->nullable();
            $table->string('enquiry_reference_no')->nullable(); // Dropdown

            // Options via radio buttons
            $table->enum('job_activity_type', ['1', '2'])->default(1)->nullable(); // 1=Single HBL, 2=Multi HBL
            $table->enum('shipment_type', ['FCL', 'LCL', 'AIR'])->default('FCL')->nullable(); // 1=FCL, 2=LCL, 3=AIR
            $table->enum('job_status', ['O', 'C'])->default('O'); // Open/Closed
            $table->enum('insurance', ['Y', 'N'])->default('Y');
            $table->enum('clearance', ['Y', 'N'])->default('Y');
            $table->enum('transportation', ['Y', 'N'])->default('Y');

            // Pre-shipment Details
            $table->date('booking_date')->nullable();
            $table->date('cargo_ready_date')->nullable();
            $table->date('pickup_date')->nullable();

            $table->foreign('job_party_id')->references('id')->on('master_import_parties')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_job_masters');
    }
};
