<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chat_documentos', function (Blueprint $table) {
            $table->id('id_chat_documento');
            $table->foreignId('id_documentos')->constrained('documentos', 'id_documento');
            $table->foreignId('id_chats')->constrained('chats', 'id_chat');
            $table->date('fecha_envio');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_documentos');
    }
};
