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
        Schema::create('categorie_niveau', function (Blueprint $table) {
            $table->bigIncrements('id_categorieNiveau'); // UNSIGNED BIGINT
            $table->string('nom_categorieNiveau');
            $table->timestamps(); // Optionnel mais recommandé
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorie_niveau');
    }
};