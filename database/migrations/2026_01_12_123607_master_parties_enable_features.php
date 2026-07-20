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
        Schema::create('master_parties_enable_features', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');
            $table->string('uuid');
            
            $table->unsignedBigInteger('shipper_id')->nullable();
            $table->foreign('shipper_id')->references('id')->on('master_export_parties')->onDelete('set null');
            $table->unsignedBigInteger('other_parties_id')->nullable();
            $table->foreign('other_parties_id')->references('id')->on('master_import_parties')->onDelete('set null');
            
            $table->enum('isFeatured', ['1', '0']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_parties_enable_features');
    }
};
