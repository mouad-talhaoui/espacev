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
        Schema::create('sence_emplois', function (Blueprint $table) {
            $table->id("id-seance_emploi");
            $table->string('id_local');
            $table->foreign('id_local')->references('id')->on('locals');
            $table->foreignId('id_creneau')->references('id')->on('crenau_emplois');
            $table->string('id_emploi')->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sence_emplois');
    }
};
