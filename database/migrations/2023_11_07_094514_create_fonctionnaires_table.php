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
        Schema::create('fonctionnaires', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string("prenom");
            $table->string("cin");
            $table->string("email");
            $table->string("password");
            $table->enum("tache",["retrait_bac","attestation","diplome","edition_licence","edition_deug","edition_master","bourse","master","multitache"])->default("multitache");
            $table->enum('password_change', ['Oui', 'Non'])->default('Non');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fonctionnaires');
    }
};