<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id('id_chat');
            $table->foreignId('id_emisor')->constrained('users', 'id_usuario');
            $table->foreignId('id_receptor')->constrained('users', 'id_usuario');
            $table->text('mensaje');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chats');
    }
};
