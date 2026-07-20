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
        Schema::create('operation_booking_containers', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');
            $table->string('uuid');

            $table->unsignedBigInteger('booking_id');

            $table->string('container_category', 10);
            $table->string('size', 20);
            $table->string('container_no', 20);
            $table->string('seal_no', 20)->nullable();
            $table->string('do_no', 20)->nullable();

            $table->foreign('booking_id')
                ->references('id')
                ->on('operation_bookings')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_booking_containers');
    }
};
