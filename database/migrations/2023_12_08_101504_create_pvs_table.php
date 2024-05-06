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
        Schema::create('pvs', function (Blueprint $table) {
            $table->integer("num_pv")->primary();
            $table->foreignId('id_planning')->references('id')->on('plannings');
            $table->string('id_local');
            $table->foreign('id_local')->references('id')->on('locals');
            $table->integer("nbr_etudiant");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pvs');
    }
};
