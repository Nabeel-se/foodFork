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
        Schema::table('recipes', function (Blueprint $table) {
            $table->json('dish_types')->nullable()->after('calories');
            $table->json('diets')->nullable()->after('dish_types');
            $table->decimal('protein', 8, 2)->nullable()->after('diets');
            $table->string('protein_unit', 10)->nullable()->after('protein');
            $table->decimal('fat', 8, 2)->nullable()->after('protein_unit');
            $table->string('fat_unit', 10)->nullable()->after('fat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn(['dish_types', 'diets', 'protein', 'protein_unit', 'fat', 'fat_unit']);
        });
    }
};
