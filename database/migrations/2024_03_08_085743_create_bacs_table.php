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
        Schema::create('bacs', function (Blueprint $table) {
            $table->id();
            $table->string("cne")->default("NULL");
            $table->string("codapo")->default("NULL");
            $table->string("nom")->default("NULL");
            $table->string("prenom")->default("NULL");
            $table->string("annee_obtention")->default("NULL");
            $table->string("annee_inscription")->default("NULL");
            $table->string("serie")->default("NULL");
            $table->string("num_archive")->default("NULL");
            $table->enum('type_retrait',['RP','RDC','NULL',])->default("NULL")->nullable(false);
            $table->string("date_retrait")->default("NULL");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bacs');
    }
};
