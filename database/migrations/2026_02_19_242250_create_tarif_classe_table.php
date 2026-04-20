<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tarif_classe', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_classe');
            $table->unsignedBigInteger('id_tarif');
            $table->boolean('statut')->default(true);
            
            $table->foreign('id_classe')
                  ->references('id_classe')
                  ->on('classe')
                  ->onDelete('cascade');
            
            $table->foreign('id_tarif')
                  ->references('id_tarif')
                  ->on('tarif')
                  ->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tarif_classe');
    }
};