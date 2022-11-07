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
        Schema::create('niveaux', function (Blueprint $table) {
            $table->id();
            $table->string('LibelleNiveau',50);
            $table->unsignedBigInteger('Filieres_id'); //One to Many pour une filière donnée (MI) on a plusieurs niveaux (L1, L2) 

            // définition des relations
            $table->foreign('Filieres_id')->references('id')->on('filieres'); 
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
        Schema::dropIfExists('niveaux');
    }
};
