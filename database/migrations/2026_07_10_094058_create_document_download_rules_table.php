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
        Schema::create('document_download_rules', function (Blueprint $table) {

            $table->id();
        
            $table->foreignId('company_id')
                  ->constrained('companies')
                  ->cascadeOnDelete();
        
            $table->string('module');          // air_import, air_export, sea_import, sea_export
        
            $table->string('document_type');   // hawb, mawb, hbl, mbl
        
            $table->string('copy_type');       // ORIGINAL 1, Draft, etc.
        
            $table->unsignedInteger('max_download')
                  ->nullable();
        
            $table->boolean('is_active')
                  ->default(true);
        
            $table->timestamps();
        
            $table->unique([
                'company_id',
                'module',
                'document_type',
                'copy_type'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_download_rules');
    }
};
