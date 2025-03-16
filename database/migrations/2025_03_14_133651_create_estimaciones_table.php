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
            $table->integer('id_tipo_e');
            $table->integer('id_formula');
            $table->double('calculo');
            $table->integer('id_troza');
            
            // Claves foráneas
            $table->foreign('id_tipo_e')->references('id_tipo_e')->on('tipo_estimaciones')->onDelete('cascade');
            $table->foreign('id_formula')->references('id_formula')->on('formulas')->onDelete('cascade');
            $table->foreign('id_troza')->references('id_troza')->on('trozas')->onDelete('cascade');
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
