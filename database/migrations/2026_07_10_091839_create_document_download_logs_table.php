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
        Schema::create('document_downloads', function (Blueprint $table) {
            $table->id();

            $table->foreignId('job_no')
                  ->constrained('operation_job_masters')
                  ->cascadeOnDelete();
                  
            $table->foreignId('company_id')
                  ->constrained('companies')
                  ->cascadeOnDelete();
        
            $table->foreignId('last_downloaded_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
                  
            $table->string('module');             // air_import, air_export, sea_import, sea_export
        
            $table->string('document_type');      // hawb, mawb, hbl, mbl
        
            $table->string('copy_type');          // ORIGINAL 1, Draft, Sea Way B/L etc.
        
            $table->unsignedInteger('download_count')->default(0);
        
            $table->timestamp('last_downloaded_at')->nullable();
        
        
            $table->timestamps();
            $table->index(['company_id', 'module', 'document_type']);
            $table->index('job_no');
        
            $table->unique([
                'company_id',
                'job_no',
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
        Schema::dropIfExists('document_downloads');
    }
};
