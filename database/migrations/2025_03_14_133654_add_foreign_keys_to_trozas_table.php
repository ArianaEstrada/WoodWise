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
        Schema::table('trozas', function (Blueprint $table) {
            $table->foreign(['id_especie'], 'trozas_ibfk_1')->references(['id_especie'])->on('especies')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_parcela'], 'trozas_ibfk_2')->references(['id_parcela'])->on('parcelas')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trozas', function (Blueprint $table) {
            $table->dropForeign('trozas_ibfk_1');
            $table->dropForeign('trozas_ibfk_2');
        });
    }
};
