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
        Schema::create('tecnicos', function (Blueprint $table) {
            $table->integer('id_tecnico', true);
            $table->integer('id_persona')->index('id_persona');
            $table->string('cedula_p')->unique('cedula_p');
            $table->string('clave_tecnico')->unique('clave_tecnico');

            $table->foreign('id_persona')->references('id_persona')->on('personas')->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tecnicos');
    }
};
