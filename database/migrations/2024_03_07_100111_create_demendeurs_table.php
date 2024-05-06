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
        Schema::create('demendeurs', function (Blueprint $table) {
            $table->id();
            $table->string("codapo");
            $table->string("cne");
            $table->string("nom");
            $table->string("prenom");
            $table->enum('type_demande',["attestation_inscription","attestation_reussit","releve_note","bac_rp","bac_rdc","attestation_deug","attestation_master","attestation_licence","deug","master","licence","carte_etudiant","bourse","releve_note_master","attestation_reussit_master"]);
            $table->string('num_archive')->default("NULL");
            $table->enum('etat_demande',['encour',"en_attente",'pret','delevré','refusé'])->default("encour")->nullable(false);
            $table->string('releve_note')->default("NULL");
            $table->string('date_retrait')->default("NULL");
            $table->string("nom_foctionnaire")->default("NULL");
            $table->string("code_demande")->default("NULL");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demendeurs');
    }
};
