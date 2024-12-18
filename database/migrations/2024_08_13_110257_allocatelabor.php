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
        Schema::create('allocatelabor', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->Integer('client_id')->nullable();
            $table->string('crew_boss')->nullable();
            $table->Integer('people')->nullable();
            $table->Integer('ranch_id')->nullable();
            $table->Integer('block_id')->nullable();
            $table->string('description')->nullable();
            $table->string('time')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('boss_amount')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allocatelabor');
    }
};
