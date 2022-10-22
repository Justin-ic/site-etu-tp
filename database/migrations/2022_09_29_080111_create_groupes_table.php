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
        Schema::create('groupes', function (Blueprint $table) {
            $table->id();
            $table->string('LibelleG',50);
            $table->unsignedBigInteger('Salles_id'); // pour une salle donnée, on a plusieurs groupe qui s'échange matin et soir
            // $table->unsignedBigInteger('tps_id'); // pour un TP donnée, on a plusieurs groupe qui s'échange matin et soir

            // définition des relations
            $table->foreign('Salles_id')->references('id')->on('salles')->onDelete('cascade')->onUpdate('cascade'); 
            // $table->foreign('tps_id')->references('id')->on('tps')->onDelete('cascade')->onUpdate('cascade'); 
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
        Schema::dropIfExists('groupes');
    }
};
