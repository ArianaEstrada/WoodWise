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
        Schema::create('asigna_parcelas', function (Blueprint $table) {
            $table->integer('id_asigna_p', true);
            $table->integer('id_tecnico')->index('id_tecnico');
            $table->integer('id_parcela')->index('id_parcela');

            $table->foreign('id_tecnico')->references('id_tecnico')->on('tecnicos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_parcela')->references('id_parcela')->on('parcelas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asigna_parcelas');
    }
};
