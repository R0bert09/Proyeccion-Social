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
        Schema::create('departamentos_test', function (Blueprint $table) {
            $table->id('id_departamento');
            $table->string('nombre_departamento', 60);
        });
    }

    public function down()
    {
        Schema::dropIfExists('departamentos_test');
    }
};