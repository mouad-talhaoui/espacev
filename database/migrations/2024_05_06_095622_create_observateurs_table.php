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
        Schema::create('observateurs', function (Blueprint $table) {
            $table->id();
            $table->foreign('id_doctrant')->references('id')->on('doctrants');
            $table->foreign('id_planning')->references('id')->on('plannings');
            $table->integer('local_id');
            $table->foreign('local_id')->references('local_id')->on('locals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observateurs');
    }
};
