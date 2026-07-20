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
        Schema::create('master_export_party_approval', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');
            $table->string('uuid');
            $table->unsignedBigInteger('party_id')->nullable();
            $table->foreign('party_id')->references('id')->on('master_export_parties')->onDelete('set null');
            
            $table->string('party_name');
            $table->text('document');
            $table->enum('approved_without_doc', ['1', '0']);
            $table->enum('approval', ['1', '0']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_export_party_approval');
    }
};
