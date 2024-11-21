@extends('layouts.appE')

@section('title', 'Dashboard - Horas Sociales')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/actualizarhoraE.css') }}">
@endsection

@section('content')
<div class="container contenedor-principal">
        <div class="tarjeta">
            <div class="encabezado-tarjeta">
                <h2>Actualizar horas del proyecto</h2>
                <p>Proyecto: <strong> {{ $proyecto->nombre_proyecto }} </strong></p>
            </div>
            <form action="{{ route('estudiante.actualizarHoras') }}" method="POST">
                @csrf
                <div class="campo-formulario">
                    <label for="horasTrabajadas" class="form-label">Horas trabajadas</label>
                    <input type="number" class="form-control" id="horasTrabajadas" name="horasTrabajadas" value="{{ old('horasTrabajadas') }}" placeholder="Ingrese las horas trabajadas">
                    @error('horasTrabajadas')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="campo-formulario">
                    <label for="documentos" class="form-label">Agregar documentos</label>
                    <input type="file" class="form-control" id="documentos" name="documentos" accept=".pdf" multiple>
                    @error('documentos')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="campo-formulario">
                    <p>Progreso actual: <strong> {{$horas->horas_sociales_completadas}} de {{$proyecto->horas_requeridas}} horas</strong></p>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="#" class="btn boton-secundario">Volver al proyecto</a>
                    <button type="submit" class="btn boton-principal">Enviar solicitud</button>
                </div>
            </form>
        </div>
    </div>
@endsection
