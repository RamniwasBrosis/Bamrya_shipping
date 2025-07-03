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
        Schema::create('master_voyages', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');
            $table->string('uuid');
            $table->string('voyage_code', 10);
            $table->string('voyage_number', 10);

            $table->unsignedBigInteger('m_vessel_id')->nullable();
            $table->foreign('m_vessel_id')
            ->references('id')->on('masters_vessels')
            ->onDelete('set null');

            $table->date('arrival_date')->nullable();
            $table->string('igm_number', 10)->nullable();
            $table->date('igm_date')->nullable();

            $table->unsignedBigInteger('shipping_line_id')->nullable();
            $table->foreign('shipping_line_id')
            ->references('id')->on('master_shippings')
            ->onDelete('set null');

            $table->string('f_voyage_no')->nullable();

            $table->unsignedBigInteger('f_vessel_id')->nullable();
            $table->foreign('f_vessel_id')
            ->references('id')->on('masters_vessels')
            ->onDelete('set null');

            $table->string('mumbai_igm_no')->nullable();
            $table->date('mumbai_igm_date')->nullable();

            $table->unsignedBigInteger('overseas_agent_id')->nullable();
            // $table->foreign('overseas_agent_id')
            // ->references('id')->on('masters_vessel')
            // ->onDelete('set null');

            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_voyages');
    }
};
