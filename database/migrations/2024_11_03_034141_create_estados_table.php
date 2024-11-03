<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadosTable extends Migration
{
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->id(); // Crea una columna `id` auto incremental
            $table->string('nombre_estado')->unique(); // Columna para el nombre del estado
            $table->timestamps(); // Para las columnas created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('estados');
    }
}

