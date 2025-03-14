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
        Schema::create('estimaciones', function (Blueprint $table) {
            $table->integer('id_estimacion', true);
            $table->integer('id_tipo_e')->index('id_tipo_e');
            $table->integer('id_formula')->index('id_formula');
            $table->double('calculo');
            $table->integer('id_troza')->index('id_troza');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimaciones');
    }
};
