<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //Création de la table actualité
        Schema::create('Actualite', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titre');
            $table->string('descriptionActualite');
            $table->date('dateEvenement');
            $table->string('photosActualite');
        });
        //Création de la table portfolio
        Schema::create('Portfolio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomEntreprise');
            $table->string('descriptionPortfolio');
            $table->string('photosPortfolio');
            $table->string('lien');
        });
        //Création de la table Personnel
        Schema::create('Personnel', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('prenoms');
            $table->string('photoPersonnel');
            $table->string('poste');
        });
    }
    public function down(): void
    {
        //
    }
};
