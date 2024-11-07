<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id('id_proyecto');
            $table->text('nombre_proyecto');
            $table->text('estado');
            $table->text('periodo');
            $table->text('lugar');
            $table->foreignId('coordinador')->constrained('users', 'id_usuario');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
