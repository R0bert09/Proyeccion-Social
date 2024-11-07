@extends('layouts.app')

@section('title', 'Proyecto')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/proyecto-general.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')

<div class="container-fluid mt-1">
    <h2 class="text-start mb-4">Proyectos</h2>
    <div class="card shadow-sm p-4" style="border-radius: 12px; overflow: hidden;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="input-group ms-auto w-25">
                <span class="input-group-text bg-light border-0">
                    <i class="bi bi-search text-secondary"></i>
                </span>
                <input type="text" class="form-control border-0" placeholder="Buscar">
                <span class="input-group-text bg-light border-0">
                    <i class="fas fa-filter custom-filter-icon"></i>
                </span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th>Título del proyecto</th>
                    <th>Estudiantes</th>
                    <th>Tutor</th>
                    <th>Fecha de inicio</th>
                    <th>Fecha de finalización</th>
                    <th>Ubicación</th>
                    <th>Estado</th>
                    <th>Sección/Departamento</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

                    <tr class="py-3">
                    <td><input type="checkbox" class="selectProject"></td>
                    <td>Gestor de TI</td>
                    <td>Kevin Nata</td>
                    <td>Josselin</td>
                    <td>10-10-24</td>
                    <td>10-07-25</td>
                    <td>UES-FMO</td>
                    <td>Anteproyecto</td>
                    <td>Sistemas Informaticos</td>
                    <td>
                            <a href="#" class="text-warning me-3"> <i class="bi bi-pencil"></i></a>
                            <a href="#" class="text-danger"> <i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <p class="mb-0">Mostrando 1 a 10 de 50 resultados</p>
            
            <div class="d-flex align-items-center">
                <select class="form-select form-select-sm w-auto">
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                </select>
                <span class="ms-2">por página</span>
            </div>
            <div class="rounded-pagination-wrapper" id="paginationWrapper">
    <div class="pagination-container">
        <nav aria-label="Navegación de página">
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item" data-page="1">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item" data-page="2"><a class="page-link" href="#">2</a></li>
                <li class="page-item" data-page="3"><a class="page-link" href="#">3</a></li>
                <li class="page-item" data-page="4"><a class="page-link" href="#">4</a></li>
                <li class="page-item" data-page="5"><a class="page-link" href="#">5</a></li>
                <li class="page-item" data-page="next">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&rsaquo;</span>
                    </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
        </div>
        <div class="button-group mt-3 px-4 mb-4">
            <button class="btn btn-success me-2">Generar PDF</button>
            <button class="btn btn-primary">Generar Excel</button>
        </div>
    </div>
</div>

<script src="{{ asset('js/proyecto-general.js') }}"></script>
@endsection