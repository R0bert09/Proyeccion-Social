@extends('layouts.app')

@section('title', 'Solicitud de Proyecto')

@section('styles')

<link rel="stylesheet" href="{{ asset('css/publiE.css') }}">

@endsection

@section('content')
<div class="container mt-4">
    <h1 class="mb-2"><strong>Solicitud de proyecto</strong></h1>
    <div class="card shadow-sm">
        <div class="card-body">
            <form>
                <!-- Campo para el nombre del proyecto -->
                <div class="mb-4">
                    <label for="nombreProyecto" class="form-label">Nombre del Proyecto</label>
                    <input type="text" class="form-control" id="nombreProyecto" placeholder="Nombre del Proyecto">
                </div>

                <!-- Campo para agregar estudiantes -->
                <div class="mb-4">
                    <label for="nombreEstudiante" class="form-label">Estudiantes</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="nombreEstudiante" placeholder="Nombre del estudiante">
                        <button type="button" class="btn btn-danger">Agregar estudiante</button>
                    </div>
                    <!-- Lista de estudiantes -->
                    <ul class="mt-3">
                        <li>Kevin Nathanael Granados Perez</li>
                        <li>Carlos Orlando Del Cid</li>
                        <li>Edars Ariel Viera Lazo</li>
                    </ul>
                </div>

                <!-- Descripción del proyecto -->
                <div class="mb-5">
                    <label for="descripcion" class="form-label">Descripción del proyecto</label>
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                        <div class="btn-toolbar flex-wrap">
                            <button type="button" class="btn btn-light btn-sm me-1"><strong>B</strong></button>
                            <button type="button" class="btn btn-light btn-sm me-1"><em>I</em></button>
                            <button type="button" class="btn btn-light btn-sm me-1"><u>U</u></button>
                            <button type="button" class="btn btn-light btn-sm me-3"><i class="bi bi-link-45deg"></i></button>
                            <button type="button" class="btn btn-light btn-sm me-1"><i class="bi bi-code-slash"></i></button>
                            <button type="button" class="btn btn-light btn-sm me-1"><i class="bi bi-list-ul"></i></button>
                            <button type="button" class="btn btn-light btn-sm ms-3"><i class="bi bi-image"></i></button>
                        </div>
                        <div class="d-flex">
                            <small class="fw-bold text-dark me-2">Edit</small>
                            <small class="text-muted">Preview</small>
                        </div>
                    </div>
                    <textarea class="form-control" id="descripcion" rows="4" placeholder="Descripción del proyecto"></textarea>
                </div>

                <!-- Ubicación y fechas -->
                <div class="row mb-5">
                    <div class="col-md-6 mb-4">
                        <label for="ubicacion" class="form-label">Ubicación</label>
                        <input type="text" class="form-control" id="ubicacion" placeholder="Ubicación">
                    </div>
                    <div class="col-md-3 mb-4">
                        <label for="fechaInicio" class="form-label">Fecha de inicio</label>
                        <input type="date" class="form-control" id="fechaInicio">
                    </div>
                    <div class="col-md-3 mb-4">
                        <label for="fechaFin" class="form-label">Fecha de finalización</label>
                        <input type="date" class="form-control" id="fechaFin">
                    </div>
                </div>

                <!-- Botón para enviar el formulario -->
                <button type="submit" class="btn btn-danger w-100">Enviar solicitud</button>
            </form>
        </div>
    </div>
</div>
@endsection
