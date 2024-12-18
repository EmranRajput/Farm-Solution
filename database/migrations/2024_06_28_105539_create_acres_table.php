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
        Schema::create('acres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ranch_id')
            ->references('id')
            ->on('ranches')
            ->cascadeOnDelete();
            $table->foreignId('block_id')
            ->references('id')
            ->on('blocks')
            ->cascadeOnDelete();
            $table->string('title');
            $table->string('description');
            $table->decimal('lat', 10, 8);
            $table->decimal('lng', 11, 8);
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acres');
    }
};
