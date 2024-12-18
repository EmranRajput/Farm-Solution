<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('setup_labor', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->Integer('ranch_id')->nullable();
            $table->Integer('block_id')->nullable();
            $table->string('commodity')->nullable();
            $table->string('variety')->nullable();
            $table->string('acres')->nullable();
            $table->string('rows')->nullable();
            $table->string('row_spacing')->nullable();
            $table->string('tree_spacing')->nullable();
            $table->string('pollinator')->nullable();
            $table->string('pollinator_spacing')->nullable();
            $table->string('trees_row')->nullable();
            $table->string('trees_acre')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('setup_labor');
    }
};
