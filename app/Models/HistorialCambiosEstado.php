<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HistorialCambiosEstado extends Model
{
    public function up()
    {
        Schema::create('historial_cambio_estado', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estado_id');
            $table->string('estado_anterior');
            $table->string('nuevo_estado');
            $table->timestamps();

            $table->foreign('estado_id')->references('id_estado')->on('Estados')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('historial_cambio_estado');
    }
}
