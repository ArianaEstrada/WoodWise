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
        Schema::table('estimaciones', function (Blueprint $table) {
            $table->foreign(['id_tipo_e'], 'estimaciones_ibfk_1')->references(['id_tipo_e'])->on('tipo_estimaciones')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_formula'], 'estimaciones_ibfk_2')->references(['id_formula'])->on('formulas')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_troza'], 'estimaciones_ibfk_3')->references(['id_troza'])->on('trozas')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estimaciones', function (Blueprint $table) {
            $table->dropForeign('estimaciones_ibfk_1');
            $table->dropForeign('estimaciones_ibfk_2');
            $table->dropForeign('estimaciones_ibfk_3');
        });
    }
};
