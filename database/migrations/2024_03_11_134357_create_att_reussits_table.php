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
        Schema::create('att_reussits', function (Blueprint $table) {
            $table->id();
            $table->string('date_validation');
            $table->string('date_delivre')->default("NULL");
            $table->string('codapo');
            $table->integer('filiere_id');
            $table->foreign('filiere_id')->references('filiere_id')->on('filieres');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('att_reussits');
    }
};
