<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('annee_academique', function (Blueprint $table) {
            $table->id('id_annee');
            $table->string('libelle')->unique(); // Ex: 2024-2025
            $table->date('date_debut');
            $table->date('date_fin');
            $table->date('date_ouverture_inscription')->nullable();
            $table->date('date_fermeture_inscription')->nullable();
            $table->date('date_ouverture_ecole')->nullable();
            $table->date('date_fermeture_classe')->nullable();
            $table->enum('statut', ['brouillon', 'publie', 'inscription_ouverte', 'inscription_fermee', 'cloture'])
                  ->default('brouillon');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('annee_academique');
    }
};