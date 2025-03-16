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
        Schema::create('trozas', function (Blueprint $table) {
            $table->integer('id_troza', true);
            $table->double('longitud');
            $table->double('diametro');
            $table->double('densidad');
            $table->integer('id_especie');
            $table->integer('id_parcela');
            
            // Claves foráneas
            $table->foreign('id_especie')->references('id_especie')->on('especies')->onDelete('cascade');
            $table->foreign('id_parcela')->references('id_parcela')->on('parcelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trozas');
    }
};
