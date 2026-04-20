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
        Schema::create('niveaux', function (Blueprint $table) {
            $table->id('id_niveaux');
            $table->string('nom_niveaux');
            $table->unsignedBigInteger('id_categorieNiveau');
            
            $table->foreign('id_categorieNiveau')
                  ->references('id_categorieNiveau')
                  ->on('categorie_niveau')
                  ->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niveaux');
    }
};