@extends('layouts.app')

@section('title', 'Perfil de Usuario')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/registro.css') }}">
@endsection

@section('content')

<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h5 class="card-title mb-4">
                <i class="bi bi-person me-2"></i> Información de perfil
            </h5>
            <form class="d-flex flex-column align-items-center">
                <div class="mb-3 w-50">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" readonly>
                </div>
                <div class="mb-3 w-50">
                    <label for="correo" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="correo" readonly>
                </div>
                <div class="mb-3 w-50">
                    <label for="rol" class="form-label">Rol</label>
                    <input type="text" class="form-control" id="rol" readonly>
                </div>
                
            </form>
        </div>
    </div>
</div>

<div class="container my-5 ">
    <div class="card shadow-sm border-0">

        <div class="card-body p-4">
            <h5 class="card-title mb-3 ">
                <i class="bi bi-lock me-2"></i> Actualizar contraseña
            </h5>

            <p class="text-muted mb-4 text-color">
                Asegúrese que su cuenta esté usando una contraseña larga y aleatoria para mantenerse seguro.
            </p>

            <form class="d-flex flex-column align-items-center">

                <div class="mb-3 w-40">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock icono-candado"></i></span>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                        <button type="button" class="btn btn-outline-secondary" id="botonMostrarContrasena" data-campo="contrasena" data-icono="iconoMostrarContrasena">
                            <i class="bi bi-eye-slash" id="iconoMostrarContrasena"></i>
                        </button>
                    </div>
    
                </div>

                <div class="mb-3 w-40">
                    <label for="nuevaContrasena" class="form-label">Nueva contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock icono-candado"></i></span>
                        <input type="password" class="form-control" id="nuevaContrasena" required>
                        <button type="button" class="btn btn-outline-secondary" id="botonMostrarContrasena2" data-campo="nuevaContrasena" data-icono="iconoMostrarNuevaContrasena">
                            <i id="iconoMostrarNuevaContrasena" class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-3 w-40">
                    <label for="confirmarContrasena" class="form-label">Confirmar contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock icono-candado"></i></span>
                        <input type="password" class="form-control" id="confirmarContrasena" required>
                        <button type="button" class="btn btn-outline-secondary" id="botonMostrarContrasena2" data-campo="confirmarContrasena" data-icono="iconoMostrarConfirmarContrasena">
                            <i id="iconoMostrarConfirmarContrasena" class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn btn-dark w-40 btn-registrarse fw-bold">
                    Actualizar contraseña
                </button>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/registro.js') }}"></script>

@endsection