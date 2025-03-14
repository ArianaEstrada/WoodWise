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
        Schema::table('turno_cortas', function (Blueprint $table) {
            $table->foreign(['id_parcela'], 'turno_cortas_ibfk_1')->references(['id_parcela'])->on('parcelas')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('turno_cortas', function (Blueprint $table) {
            $table->dropForeign('turno_cortas_ibfk_1');
        });
    }
};
