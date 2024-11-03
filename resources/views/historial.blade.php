@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Historial de Cambios de Estado</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Estado ID</th>
                <th>Nuevo Estado</th>
                <th>Fecha de Cambio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historial as $cambio)
                <tr>
                    <td>{{ $cambio->id }}</td>
                    <td>{{ $cambio->estado_id }}</td>
                    <td>{{ ucfirst($cambio->nuevo_estado) }}</td>
                    <td>{{ $cambio->fecha_cambio }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
