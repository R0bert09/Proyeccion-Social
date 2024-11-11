@extends('layouts.app')

@section('title', 'Gestión de Permisos')

@section('content')
<div class="container mt-4">
    <!-- Formulario para crear nuevo permiso -->
    <h2>Crear nuevo permiso</h2>
    <div class="card mb-4">
        <div class="card-header">
            <h5>Detalles del nuevo permiso</h5>
            <p class="text-muted">Defina los nuevos permisos</p>
        </div>
        <div class="card-body">
            <form action="{{ route('permissions.store') }}" method="POST">
                @csrf
                <div class="mb-3 m-1">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="name" placeholder="Ingrese el nuevo permiso" required>
                </div>
                <button type="submit" class="btn btn-primary">Crear nuevo permiso</button>
            </form>
        </div>
    </div>

    <!-- Tabla de permisos existentes -->
    <h4 class="mb-3">Permisos Existentes</h4>
    <div class="card mb-4">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td class="text-end">
                            <a href="#" class="text-warning text-decoration-none" data-bs-toggle="modal" data-bs-target="#editPermissionModal" onclick="populateEditForm('{{ $permission->id }}', '{{ $permission->name }}')">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger p-0"><i class="bi bi-trash-fill"></i> Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de edición -->
<div class="modal fade" id="editPermissionModal" tabindex="-1" aria-labelledby="editPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPermissionModalLabel">Editar Permiso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPermissionForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editPermissionName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="editPermissionName" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function populateEditForm(id, name) {
        const form = document.getElementById('editPermissionForm');
        form.action = `/permissions/${id}`;
        document.getElementById('editPermissionName').value = name;
    }
</script>

@endsection