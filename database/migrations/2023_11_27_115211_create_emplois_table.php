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
        Schema::create('emplois', function (Blueprint $table) {
            $table->id();
            $table->string("date");
            $table->string("heure");
            $table->string('id_local');
            $table->foreign('id_local')->references('id')->on('locals');
            // $table->foreignId('id_local')->references('id')->on('locals');
            $table->foreignId('id_seance')->references('id')->on('seances');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emplois');
    }
};
