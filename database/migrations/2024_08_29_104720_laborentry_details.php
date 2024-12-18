<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('laborentry_details', function (Blueprint $table) {
            $table->id();
            $table->Integer('client_id')->nullable();
            $table->date('date');
            $table->string('crew_boss')->nullable();
            $table->string('invoice')->nullable();
            $table->string('company')->nullable();
            $table->Integer('people')->nullable();
            $table->Integer('ranch_id')->nullable();
            $table->Integer('block_id')->nullable();
            $table->string('description')->nullable();
            $table->Integer('total_amount')->nullable();
            $table->string('full_time')->nullable();
            $table->Integer('comission')->nullable();
            $table->Integer('crewboss_amount')->nullable();
            $table->TinyInteger('invoice_category')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laborentry_details');
    }
};
