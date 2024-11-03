@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Cambiar Estado</h2>
    <div class="card mb-4">
        <div class="card-body">
            <h5>Estado Actual: {{ $estado->nombre_estado }}</h5>
        </div>
    </div>
    
    <form action="{{ url('/estados/' . $estado->id_estado . '/cambiar-estado') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-3">
            <label for="nuevo_estado">Nuevo Estado</label>
            <select name="nuevo_estado" id="nuevo_estado" class="form-control" required>
                <option value="">Seleccionar Estado</option>
                
                @foreach ($estadosPermitidos as $estadoPermitido)
                    <option value="{{ $estadoPermitido }}">{{ ucfirst($estadoPermitido) }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Actualizar Estado</button>
    </form>
</div>
@endsection
