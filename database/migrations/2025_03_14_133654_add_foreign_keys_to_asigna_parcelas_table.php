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
        Schema::table('asigna_parcelas', function (Blueprint $table) {
            $table->foreign(['id_tecnico'], 'asigna_parcelas_ibfk_1')->references(['id_tecnico'])->on('tecnicos')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_parcela'], 'asigna_parcelas_ibfk_2')->references(['id_parcela'])->on('parcelas')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asigna_parcelas', function (Blueprint $table) {
            $table->dropForeign('asigna_parcelas_ibfk_1');
            $table->dropForeign('asigna_parcelas_ibfk_2');
        });
    }
};
