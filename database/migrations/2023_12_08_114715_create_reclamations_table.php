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
        Schema::create('reclamations', function (Blueprint $table) {
            $table->id();
            $table->integer("codapo");
            //type_reclamation(liste,bourse)
            $table->enum('type_reclamation',['liste','bourse']);
            $table->text("sujet");
            $table->text("reponse");
            $table->string("date_reclamation");
            $table->boolean("traite");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reclamations');
    }
};
