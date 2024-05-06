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
        Schema::create('numerotations', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('id_local')->references('id')->on('locals');
            $table->string('id_local');
            $table->foreign('id_local')->references('id')->on('locals');
            $table->integer("numero_place");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('numerotations');
    }
};
