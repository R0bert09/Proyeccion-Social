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
        Schema::create('secciones', function (Blueprint $table) {
            $table->id('id_seccion');
            $table->text('nombre_seccion');
            $table->foreignId('id_departamento')
                  ->references('id_departamento') 
                  ->on('departamentos')
                  ->onDelete('cascade');
            $table->foreignId('id_coordinador')
                  ->references('id_usuario')
                  ->on('users')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('secciones');
    }
};
