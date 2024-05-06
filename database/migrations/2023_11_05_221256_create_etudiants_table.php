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
        Schema::create('etudiants', function (Blueprint $table) {
            $table->integer("id")->primary();
            $table->string('cne');
            $table->string('cin');
            $table->string('nom');
            $table->string('nom_ar');
            $table->string('prenom');
            $table->string('prenom_ar');
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('date_naissance');
            $table->string('lieu_naissance');
            $table->string('lieu_naissance_ar');
            $table->enum('password_change', ['Oui', 'Non'])->default('Non');
            $table->enum('stuation_annuel', ['Inscrit', 'Non'])->default('Non');
            $table->enum('stuation_autmn',['Inscrit','Fraud','Valide','Non'])->default('Inscrit');
            $table->enum('stuation_print',['Inscrit','Fraud','Valide','Non'])->default('Inscrit');
            $table->enum('stuation_S1',['Inscrit','Valide','Non Inscrit','Non Valide'])->default('Non Inscrit');
            $table->enum('stuation_S2',['Inscrit','Valide','Non Inscrit','Non Valide'])->default('Non Inscrit');
            $table->enum('stuation_S3',['Inscrit','Valide','Non Inscrit','Non Valide'])->default('Non Inscrit');
            $table->enum('stuation_S4',['Inscrit','Valide','Non Inscrit','Non Valide'])->default('Non Inscrit');
            $table->enum('stuation_S5',['Inscrit','Valide','Non Inscrit','Non Valide'])->default('Non Inscrit');
            $table->enum('stuation_S6',['Inscrit','Valide','Non Inscrit','Non Valide'])->default('Non Inscrit');
            $table->enum('stuation_S7',['Inscrit','Valide','Non Inscrit','Non Valide'])->default('Non Inscrit');
            $table->enum('stuation_S8',['Inscrit','Valide','Non Inscrit','Non Valide'])->default('Non Inscrit');
            $table->enum('stuation_S9',['Inscrit','Valide','Non Inscrit','Non Valide'])->default('Non Inscrit');
            $table->enum('stuation_S10',['Inscrit','Valide','Non Inscrit','Non Valide'])->default('Non Inscrit');
            $table->integer('filiere_id');
            $table->foreign('filiere_id')->references('filiere_id')->on('filieres');
            $table->string('diplome');
            $table->rememberToken();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
