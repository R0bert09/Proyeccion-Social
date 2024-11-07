<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('seccion_tutor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_seccion')
                  ->references('id_seccion')
                  ->on('secciones')
                  ->onDelete('cascade');
            $table->foreignId('id_tutor')
                  ->references('id_usuario')
                  ->on('users')
                  ->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['id_seccion', 'id_tutor']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('seccion_tutor');
    }
};