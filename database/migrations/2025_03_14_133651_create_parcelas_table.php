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
        Schema::create('parcelas', function (Blueprint $table) {
            $table->integer('id_parcela', true);
            $table->string('nom_parcela')->unique('nom_parcela');
            $table->string('ubicacion');
            $table->integer('id_productor')->index('id_productor');
            $table->string('extension');
            $table->text('direccion');
            $table->integer('CP');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcelas');
    }
};
