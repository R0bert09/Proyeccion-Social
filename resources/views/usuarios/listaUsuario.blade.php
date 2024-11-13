@extends('layouts.app')

@section('title', 'Lista de Usuarios')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    .w-5,.h-5 {
        width: 1rem;
        height: 1rem;
    }
    div p.text-sm.text-gray-700.leading-5.dark\:text-gray-400 {
        display: none;
    }
    .flex.justify-between.flex-1.sm\:hidden > span,
    .flex.justify-between.flex-1.sm\:hidden > a {
        display: none;
    }
</style>

<div class="container-fluid mt-1">
    <h2 class="text-start mb-4">Lista de Usuarios</h2>
    <div class="card shadow-sm p-4" style="border-radius: 12px; overflow: hidden;">
        <form method="POST" action="{{ route('usuarios.eliminar') }}" id="deleteForm">
            @csrf
            @method('DELETE')
            <div class="d-flex justify-content-between align-items-center mb-3">
                <button type="submit" class="btn btn-danger">Eliminar seleccionados</button>
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
                            <th scope="col"><input type="checkbox" id="selectAll"></th>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo Electrónico</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Sección/Departamento</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $usuario)    
                        <tr>
                            <td><input type="checkbox" name="users[]" value="{{ $usuario->id_usuario }}"></td>
                            <td>{{ $usuario->id_usuario }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->getRoleNames()->first() ?? 'Sin rol' }}</td>
                            <td>{{ $usuario->seccion}}</td>
                            <td>
                                <a href="{{ route('usuarios.editarUsuario', ['id' => $usuario->id_usuario]) }}" class="text-warning me-3"><i class="bi bi-pencil"></i> Editar</a>
                                <a href="#" class="text-danger"><i class="bi bi-trash"></i> Eliminar</a>
                                <a href="{{ route('perfil', ['id' => $usuario->id_usuario]) }}" class="text-danger"><i class="bi bi-eye"></i> Mostrar</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </form>

        <form method="GET" action="{{ route('usuarios') }}" class="d-flex justify-content-between align-items-center mt-3">
            <p class="mb-0">Mostrando {{ $users->firstItem() }} a {{ $users->lastItem() }} de {{ $users->total() }} resultados</p>
            
            <div class="d-flex align-items-center">
                <select name="per_page" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                </select>
                <span class="ms-2">por página</span>
            </div>

            <div class="rounded-pagination-wrapper" id="paginationWrapper">
                <div class="pagination-container">
                    {{ $users->appends(['per_page' => request('per_page')])->links() }}
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('selectAll').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('input[name="users[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });
</script>
@endsection
