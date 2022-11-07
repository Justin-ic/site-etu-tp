<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscrits', function (Blueprint $table) {
            $table->id(); 

            // définition des cléef étrangères
            $table->unsignedBigInteger('Etudiants_id'); // Relation One To Many: un etudiant peut sincrire plusieurs fois en fonction de l'anne.
            $table->unsignedBigInteger('AnneeUnivs_id'); // Relation One To Many: pour une anne, on a plusieurs iscrits
            $table->unsignedBigInteger('Niveaus_id'); // Relation One To Many: pour un niveau, on a plusieurs inscrits de niveau different
            $table->unsignedBigInteger('TPs_id'); // Relation One To Many: pour un TP, on a plusieurs etudiants inscrits
            $table->unsignedBigInteger('Groupes_id')->nullable(); // Relation One to Many: pour un groupe, on a plusieurs etudiants inscrits


            // $table->unsignedBigInteger('services_id'); // Relation One to Many

 
            // définition des relations
            $table->foreign('Etudiants_id')->references('id')->on('etudiants')->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreign('AnneeUnivs_id')->references('id')->on('annee_univs')->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreign('Niveaus_id')->references('id')->on('niveaux')->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreign('TPs_id')->references('id')->on('tps')->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreign('Groupes_id')->references('id')->on('groupes');
            // ->onDelete('cascade')->onUpdate('cascade'); 
            $table->timestamps();
        });
    }



 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscrits');
    }
};
