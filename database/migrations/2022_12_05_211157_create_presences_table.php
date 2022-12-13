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
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->integer('etat')->default(0); // 0= absent
            $table->unsignedBigInteger('Inscrits_id'); // Relation One to One: pour un ID de présence, on a un et un seul inscrits 

            // définition des relations
            $table->foreign('Inscrits_id')->references('id')->on('inscrits')->onUpdate('cascade'); 
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
        Schema::dropIfExists('presences');
    }
};
