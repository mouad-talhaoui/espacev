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
        Schema::create('frauds', function (Blueprint $table) {
            $table->id();
            $table->integer("num_pv");
            $table->foreign('num_pv')->references('num_pv')->on('pvs');
            $table->string('id_ip');
            $table->foreign('id_ip')->references('id')->on('ips');
            $table->string("type");
            $table->string("type_sanction");
            $table->string("remarque");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frauds');
    }
};
