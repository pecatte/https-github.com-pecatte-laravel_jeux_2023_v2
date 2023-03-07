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
        Schema::create('categories', function (Blueprint $table) {
            $table->id('id_categorie');
            $table->string('nom_categorie');
            $table->timestamps();
        });
        Schema::create('jeux', function (Blueprint $table) {
            $table->id('id_jeu');
            $table->string('nom_jeu');
            $table->string('logo_jeu');
            $table->integer('nb_joueurs');
            $table->time('temps_partie');
            $table->string('regles');
            $table->string('materiel');

            $table->timestamps();

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger('id_categorie');
            $table->foreign('id_categorie')->references('id_categorie')->on('categories');
        });
        Schema::create('commenter', function (Blueprint $table) {
            $table->string('commentaire');
            $table->integer('note');
            $table->timestamps();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger('id_jeu');
            $table->foreign('id_jeu')->references('id_jeu')->on('jeux');
            $table->primary(['id_user', 'id_jeu']);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commenter');
        Schema::dropIfExists('jeux');
        Schema::dropIfExists('categories');
    }
};