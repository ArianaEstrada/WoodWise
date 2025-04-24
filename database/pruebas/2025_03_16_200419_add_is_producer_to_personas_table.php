<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->boolean('is_producer')->default(false); // O el tipo adecuado
        });
    }
    
    public function down()
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->dropColumn('is_producer');
        });
    }
    
};
