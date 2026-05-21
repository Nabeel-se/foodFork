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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('spoonacular_id')->unique(); // Ensure unique Spoonacular IDs
            $table->index('spoonacular_id'); // Add an index for faster lookups
            $table->string('title');
            $table->string('image')->nullable();
            $table->text('summary')->nullable();
            $table->text('instructions')->nullable();
            $table->integer('ready_in_minutes')->nullable();
            $table->integer('servings')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
