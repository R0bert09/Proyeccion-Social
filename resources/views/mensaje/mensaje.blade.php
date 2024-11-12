@extends('layouts.app')

@section('title', 'Mensajes')

@section('content')

<div class="container-fluid">
    <div class="row chat-container">
      
      <!-- Sidebar de navegación -->
      <div class="col-12 col-md-3 sidebar d-flex flex-column rounded-3" id="sidebar">
        <h5 class="px-3">Chats</h5>
          <div class="d-flex justify-content-between align-items-center px-3 py-2">
                <div class="input-group">
                      <span class="input-group-text bg-white border-0"><i class="bi bi-search"></i></span>
                      <input type="text" class="form-control border-0" placeholder="Buscar">
                  </div>
                  <button class="btn btn-link text-danger text-uppercase fw-bold ms-2">Chat +</button>
               </div>
        <div class="chat-list">
          <!-- Lista de chats -->
          <div class="chat-item active rounded-3">
            <img src="https://via.placeholder.com/40" alt="User">
            <div>
              <strong>Elian Francisco</strong><br>
              <small>Coordinador</small>
            </div>
          </div>
          <div class="chat-item rounded-3">
            <img src="https://via.placeholder.com/40" alt="User">
            <div>
              <strong>Kevin Nathanael</strong><br>
              <small>Tutor</small>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex d-md-none justify-content-end px-3 py-2">
            <button class="btn btn-outline-secondary" onclick="toggleSidebar()">Mostrar Chats</button>
        </div>

      <!-- Ventana de chat -->
      <div class="col-12 col-md-9 ventana d-flex flex-column">
        <!-- Encabezado del chat -->
        <div class="chat-header d-flex align-items-center rounded-top-4">
          <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="User">
          <div>
            <strong>Elian Francisco</strong><br>
            <small>Coordinador</small>
          </div>
        </div>

        <!-- Área de mensajes -->
        <div id="messageContainer" class="chat-messages d-flex flex-column p-3 ">
          <div class="message received">
            Lorem ipsum has been the industry's standard dummy text ever since the 1500s.
            <small class="text-muted">8:00 PM</small>
          </div>
          <div class="message sent">
            Lorem ipsum has been the industry's standard dummy text ever since the 1500s.
            <small class="text-white-50">8:00 PM</small>
          </div>
          <div class="message received">
            Lorem ipsum has been the industry's standard dummy text ever since the 1500s.
            <small class="text-muted">8:00 PM</small>
          </div>
          <div class="message sent">
            Lorem ipsum has been the industry's standard dummy text ever since the 1500s.
            <small class="text-white-50">8:00 PM</small>
          </div>
        </div>

        <!-- Pie de entrada de mensaje -->
        <div class="chat-footer d-flex align-items-center rounded-bottom-3">
        <input type="text" id="messageInput" class="form-control" placeholder="Escriba un mensaje" onkeydown="sendMessage(event)">
          <button class="btn"><i class="bi bi-send"></i></button>
          <button class="btn" onclick="document.getElementById('fileInput').click();">
                    <i class="bi bi-paperclip"></i>
                </button>
                <input type="file" id="fileInput" style="display: none;">
          <button class="btn"><i class="bi bi-check2"></i></button>
        </div>
      </div>
    </div>
  </div>

@endsection