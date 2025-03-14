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
            $table->integer('id_especie')->index('id_especie');
            $table->integer('id_parcela')->index('id_parcela');
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
