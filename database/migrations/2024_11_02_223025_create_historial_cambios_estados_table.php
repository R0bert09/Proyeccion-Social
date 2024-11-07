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
        Schema::create('historial_cambios_estado', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_estado')->constrained('estados', 'id_estado')->onDelete('cascade');
            $table->string('nuevo_estado');
            $table->timestamp('fecha_cambio')->useCurrent();
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('historial_cambios_estado');
    }
};
