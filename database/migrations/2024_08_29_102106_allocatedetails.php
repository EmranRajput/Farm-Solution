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
        Schema::create('allocate_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('allocate_id')->nullable()->constrained('laborentry_details')->onDelete('cascade');
            $table->Integer('crewboss_id')->nullable();
            $table->Integer('crew_price')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allocate_details');
    }
};
