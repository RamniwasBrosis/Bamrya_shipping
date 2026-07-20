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
        Schema::create('operation_booking_file_uploads', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('uuid');
            $table->string('file_name');
            $table->string('file_path');
            $table->unsignedBigInteger('booking_no')->nullable();
            $table->foreign('booking_no')->references('id')->on('operation_bookings')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_booking_file_uploads');
    }
};
