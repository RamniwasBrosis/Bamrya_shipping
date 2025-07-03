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
        Schema::create('operation_all_file_uploads', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('uuid');
            $table->string('file_name', '100');
            $table->string('file_path', '100');
            $table->string('file_type', '100');
            $table->string('file_related', '50');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_all_file_uploads');
    }
};
