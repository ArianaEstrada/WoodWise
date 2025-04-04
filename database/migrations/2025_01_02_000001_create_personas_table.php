<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->integer('id_persona', true);
            $table->string('nom');
            $table->string('ap');
            $table->string('am');
            $table->string('telefono');
            $table->string('correo')->unique();
            $table->string('contrasena');
            $table->integer('id_rol')->index('id_rol');
            $table->foreign('id_rol')->references('id_rol')->on('roles')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
