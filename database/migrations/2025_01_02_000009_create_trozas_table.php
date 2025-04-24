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
            $table->id('id_troza');
            $table->double('longitud');
            $table->double('diametro');
            $table->double('diametro_otro_extremo')->nullable();
            $table->double('diametro_medio')->nullable();
            $table->double('densidad');
            $table->unsignedBigInteger('id_especie');
            $table->unsignedBigInteger('id_parcela');
            
            $table->foreign('id_especie')->references('id_especie')->on('especies');
            $table->foreign('id_parcela')->references('id_parcela')->on('parcelas');
            
            $table->timestamps();
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
