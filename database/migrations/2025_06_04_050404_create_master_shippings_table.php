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
        Schema::create('master_shippings', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('uuid');
            $table->string('shipping_line_code', 10);
            $table->string('shipping_line_name', 100);
            $table->string('address_line_1', 100);
            $table->string('address_line_2', 100)->nullable();
            $table->string('agent_code', 10)->nullable();
            $table->string('line_code', 10)->nullable();
            $table->enum('shipping_line_type', ['1', '2']); // 1: Indian, 2: Overseas
            $table->boolean('status')->default(1); // 1 = Active, 0 = Inactive

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_shippings');
    }
};
