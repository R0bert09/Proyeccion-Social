@extends('layouts.app')

@section('title', 'Mensajes')

@section('content')
<div class="container mx-auto my-8 p-4 max-w-xl">
    <h1 class="text-2xl font-bold text-center mb-4">Chat </h1>
    <div id="chat-box" class="h-72 border border-gray-300 rounded p-4 overflow-y-scroll mb-4 bg-white shadow-md"></div>
    <div class="flex">
        <input 
            type="text" 
            id="input-message" 
            class="flex-grow border border-gray-300 rounded-l px-4 py-2 focus:outline-none focus:ring focus:ring-blue-200" 
            placeholder="Escribe un mensaje">
        <button 
            id="send-button" 
            class="bg-blue-500 text-white px-6 py-2 rounded-r hover:bg-blue-600 transition">
            Enviar
        </button>
    </div>
</div>
<script src="{{ asset('js/chat.js') }}"></script>
@endsection


