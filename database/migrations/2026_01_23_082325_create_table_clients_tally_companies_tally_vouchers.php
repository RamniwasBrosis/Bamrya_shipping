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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('uuid');
            $table->string('name');
            $table->string('status')->default('active');
            $table->timestamps();
        });
        
        Schema::create('tally_companies', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('uuid');
            $table->foreignId('client_id')->constrained();
            $table->string('company_name');
            $table->string('company_guid')->nullable();
            $table->timestamps();
        });
        
        Schema::create('tally_vouchers', function (Blueprint $table) {
            $table->id();
            
            $table->integer('company_id');
            $table->string('uuid');
            
            $table->foreignId('client_id')->constrained();
            $table->foreignId('tally_company_id')->constrained();
        
            $table->string('voucher_guid')->unique();
            $table->bigInteger('alter_id')->default(0);
        
            $table->string('voucher_type'); // Sales / Purchase
            $table->string('voucher_no');
            $table->date('voucher_date');
        
            $table->string('party_name')->nullable();
            $table->decimal('amount', 15, 2)->default(0);
        
            $table->boolean('is_deleted')->default(false);
            $table->timestamp('synced_at')->nullable();
        
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_clients_tally_companies_tally_vouchers');
        Schema::dropIfExists('tally_companies');
        Schema::dropIfExists('tally_vouchers');
    }
};
