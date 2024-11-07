<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->id('id_asignacion');
            $table->foreignId('id_proyecto')->constrained('proyectos', 'id_proyecto');
            $table->foreignId('id_estudiante')->constrained('estudiantes', 'id_estudiante');
            $table->foreignId('id_tutor')->constrained('users', 'id_usuario');
            $table->date('fecha_asignacion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asignaciones');
    }
};