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
        Schema::create('surveillances', function (Blueprint $table) {
            $table->id();
            $table->string("type_surv");
            $table->integer("num_pv");
            $table->foreign("num_pv")->references("num_pv")->on('pvs');
            $table->integer("id_surviant");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveillances');
    }
};
