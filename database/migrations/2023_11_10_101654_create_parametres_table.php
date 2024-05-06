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
        Schema::create('parametres', function (Blueprint $table) {
            $table->id();
            $table->boolean("confirmation")->default(false);
            $table->enum('session',['printemp','automn'])->default("printemp")->nullable(false);
            $table->boolean("convocation")->default(false);
            $table->boolean("reclamation_note")->default(false);
            $table->enum('session_examen',['normal','rattrapage'])->default("normal")->nullable(false);
            $table->enum('session_reclamation',['normal','rattrapage'])->default("normal")->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parametres');
    }
};
