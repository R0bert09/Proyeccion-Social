@extends('layouts.app') <!-- Extiende tu layout principal si lo tienes -->

@section('content')
<div class="container">
    <h1>Asignar Fechas</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('proyectos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="date" class="form-control" name="fecha_inicio" required>
        </div>

        <div class="form-group">
            <label for="fecha_fin">Fecha de Fin:</label>
            <input type="date" class="form-control" name="fecha_fin" required>
        </div>

        <button type="submit" class="btn btn-primary">Crear Proyecto</button>
    </form>
</div>
@endsection
