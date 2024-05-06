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
        Schema::create('reclamation_notes', function (Blueprint $table) {
            $table->id();
            $table->enum('type_reclamation',['note','abscent']);
            $table->string("id_ip");
            $table->string("codeapo");
            $table->string("date_reclamation");
            $table->string("salle_examen")->nullable();
            $table->string("reponse_apogee")->nullable();
            $table->string("etat_reclamation")->default('En attente de la réponse du professeur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reclamation_notes');
    }
};
