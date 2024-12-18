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
        Schema::create('crew_setup', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('crewboss_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('job_id')->nullable()->constrained('jobdescription')->onDelete('cascade');
            $table->string('labor_contructor');
            $table->Integer('comission_rate')->nullable();
            $table->Integer('wage_rate')->nullable();
            $table->Integer('crewboss_wage_high')->nullable();
            $table->Integer('crewboss_wage_low')->nullable();
            $table->Integer('graft_chainsaw')->nullable();
            $table->Integer('lunch_break')->nullable();
            $table->Integer('break1')->nullable();
            $table->Integer('break2')->nullable();
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
        Schema::dropIfExists('crew_setup');
    }
};
