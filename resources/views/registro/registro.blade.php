<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
    <title>Registro</title>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100 bg-light">
        <div class="card p-4 registro-card shadow">
            <h3 class="text-center mb-4 fw-bold">Registrarse</h3>
    
            <form action="{{ route('usuarios.registro') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="correo" class="form-label">Nombre</label>
                    <div class="input-group">
                        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombre" placeholder="Nombre">
                    </div>
                    <label for="correo" class="form-label">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope "></i></span>
                        <input type="email" name="correo" class="form-control @error('correo') is-invalid @enderror" id="correo" placeholder="example@ues.edu.sv">
                    </div>
                </div>

            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock icono-candado"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                    <button type="button" class="btn btn-outline-secondary" id="botonMostrarContrasena" data-campo="contrasena" data-icono="iconoMostrarContrasena">
                        <i class="bi bi-eye-slash" id="iconoMostrarContrasena"></i>
                    </button>
                </div>

            </div>
    
                <div class="mb-3">
                    <label for="confirmarContrasena" class="form-label">Confirmar Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock icono-candado"></i></span>
                        <input type="password" class="form-control" id="confirmarContrasena" placeholder="Confirmar contraseña" required>
                        <button type="button" class="btn btn-outline-secondary" id="botonMostrarContrasena2" data-campo="confirmarContrasena" data-icono="iconoMostrarConfirmarContrasena">
                            <i id="iconoMostrarConfirmarContrasena" class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>
    
                <div class="mb-4 row">
                    <div class="col-md-8">
                        <label for="id_seccion" class="form-label">Sección/Departamento</label>
                        <select name="id_seccion" class="form-select @error('departamento') is-invalid @enderror" id="id_seccion">
                            <option selected>Seleccionar departamento</option>
                        @foreach($secciones as $seccion)
                            <option value="{{$seccion->id_seccion}}">{{$seccion->nombre_seccion}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-dark w-100 btn-registrarse">Registrarse</button>
                <div class="text-center mt-3 ">
                    <p>¿Ya tienes una cuenta? <a href="{{ asset('') }}" class="link-inicar-sesion fw-bold">Inicia Sesión Aquí</a></p>
                </div>
    
            </form>
        </div>
    </div>
    
        <!-- validacion de errores -->
        @if ($errors->any())
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div class="toast show align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/registro.js') }}"></script>
    <script src="{{ asset('js/comprobarContrasenia.js') }}"></script>
</body>
</html>