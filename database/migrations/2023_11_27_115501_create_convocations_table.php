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
        Schema::create('convocations', function (Blueprint $table) {
            $table->id();
            $table->string('id_ip');
            $table->foreign('id_ip')->references('id')->on('ips');
            $table->foreignId('id_planning')->references('id')->on('plannings');
            $table->foreignId('id_numerotation')->references('id')->on('numerotations');
            $table->enum('session',['normal','rattrapage'])->default('normal')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convocations');
    }
};
