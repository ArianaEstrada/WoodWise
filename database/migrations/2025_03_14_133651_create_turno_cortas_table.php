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
        Schema::create('turno_cortas', function (Blueprint $table) {
            $table->integer('id_turno', true);
            $table->integer('id_parcela')->index('id_parcela');
            $table->string('codigo_corta')->unique('codigo_corta');
            $table->date('fecha_corta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turno_cortas');
    }
};
