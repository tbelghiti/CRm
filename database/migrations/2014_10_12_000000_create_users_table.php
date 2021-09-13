<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('prenom');
            $table->string('nom');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // $table->string('profil_id');
            $table->string('poste')->nullable();
            $table->date('naissance')->nullable();
            $table->double('base_salaire')->nullable();
            $table->string('cv')->nullable();
            $table->string('photo')->nullable();
            $table->date('date_recrutement')->nullable();
            $table->dateTime('date_derniere_connexion')->nullable();
            $table->string('lieu_du_travail')->nullable();
            $table->string('contrat')->nullable();
            $table->string('statut')->nullable();
            $table->string('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->string('pays')->nullable();
            $table->string('telephone1')->nullable();
            $table->string('telephone2')->nullable();
            $table->string('note1')->nullable();
            $table->string('note2')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
