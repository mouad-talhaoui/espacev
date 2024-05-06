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
        Schema::create('diplomes', function (Blueprint $table){
            $table->id();
            $table->string('codapo');
            $table->enum('type_deplome',['deug','licence',"master",'null'])->default("null");
            $table->string('date_retrait')->default("NULL");
            $table->enum('date_edition',['NON','OUI'])->default("NON");
            $table->string('date_deliberation')->default("NULL");
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
        Schema::dropIfExists('diplomes');
    }
};
