@extends('layouts.app')

@section('title', 'Solicitud de Proyecto')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/proyecto-general.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@section('content')
<h1>Solicitudes</h1>
<form id="proyectosForm" action="{{ route('proyectos.generar') }}" method="POST">
    @csrf
    <input type="hidden" name="action" id="actionInput">

    <div class="tabla-contenedor shadow-sm rounded bg-white">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Correlativo</th>
                        <th>Estudiante</th>
                        <th>Proyecto</th>
                        <th>Valor</th>
                        <th>Fecha de solicitud</th>
                        <th>estado</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    @if ($solicitudes->isEmpty())

                    <tr>
                        <td colspan="7" class="text-center">No hay solicitudes</td>
                    </tr>

                    @endif
                    @foreach($solicitudes as $solicitud)
                    <tr>
                        <td>{{ $solicitud->solicitud_id }}</td>
                        <td>{{$nombresEstudiantes[0]}}</td>
                        <td>{{ $proyecto->nombre_proyecto }}</td>
                        <td>{{ $solicitud->valor }} Hr(s)</td>
                        <td>{{ $solicitud->created_at }}</td>
                        <td>@if ($solicitud->estado == 6)
                            <span class="badge bg-danger">{{$estados[$solicitud->estado]->nombre_estado}}</span>
                            @elseif ($solicitud->estado == 7)
                            <span class="badge bg-info">{{$estados[$solicitud->estado]->nombre_estado}}</span>
                            @elseif ($solicitud->estado == 9)
                            <span class="badge bg-success">{{$estados[$solicitud->estado]->nombre_estado}}</span>
                            @else
                            <span class="badge bg-info">{{$estados[$solicitud->estado]->nombre_estado}}</span>

                        </td>

                        @endif

                        <td style="display: flex;">

                            <!--Boton de solicitudes-->
                            <a class="btn btn-light btn-sm p-2 px-3">
                                <i class="bi bi-info"></i>
                            </a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-3 d-flex flex-column flex-md-row justify-content-between align-items-center bg-light border-top">
                <span class="text-muted mb-2 mb-md-0">Mostrando 1 a 10 de 50 resultados</span>
                <div class="d-flex align-items-center gap-2 mb-2 mb-md-0">
                    <select class="form-select form-select-sm" style="width: auto;">
                        <option>10</option>
                        <option>20</option>
                        <option>50</option>
                    </select>
                    <span>por página</span>
                </div>
                <ul class="paginacion d-flex gap-2 mb-0">
                    <li class="pagina-item activo">
                        <a class="pagina-enlace" href="#">1</a>
                    </li>
                    <li class="pagina-item"><a class="pagina-enlace" href="#">2</a></li>
                    <li class="pagina-item"><a class="pagina-enlace" href="#">3</a></li>
                    <li class="pagina-item"><a class="pagina-enlace" href="#">4</a></li>
                    <li class="pagina-item"><a class="pagina-enlace" href="#">5</a></li>
                    <li class="pagina-item"><a class="pagina-enlace" href="#"><i class="bi bi-chevron-right"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</form>
<script>
    function submitForm(action) {
        const form = document.getElementById('proyectosForm');
        const actionInput = document.getElementById('actionInput');
        actionInput.value = action;

        if (action === 'delete') {
            const confirmDelete = confirm('¿Estás seguro de que deseas eliminar los proyectos seleccionados?');
            if (!confirmDelete) return;
        }

        form.submit();
    }
</script>

<script src="{{ asset('js/proyecto-general.js') }}"></script>
@endsection
