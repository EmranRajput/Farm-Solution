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
        schema::create('labor_entry', function(Blueprint $table){
            $table->id('id');
            $table->Integer('client_id')->nullable();
            $table->date('entry_date');
            $table->foreignId('crew_boss')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('of_people')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('ranch_id')->nullable()->constrained('ranches')->onDelete('cascade');
            $table->foreignId('block_id')->nullable()->constrained('blocks')->onDelete('cascade');
            $table->foreignId('job_id')->nullable()->constrained('jobdescription')->onDelete('cascade');
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('starttime')->nullable();
            $table->string('endtime')->nullable();
            $table->Integer('binspicked')->nullable();
            $table->Integer('treescompleted')->nullable();
            $table->Integer('rowscompleted')->nullable();
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
        schema::dropIfExists('labor_entry');
    }
};
