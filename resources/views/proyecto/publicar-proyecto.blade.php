@extends('layouts.app')
@section('title', 'Publicar Proyecto')
@section('content')
<div class="container mt-4">
    <!-- Mostrar el mensaje de éxito si existe -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
<div class="container mt-4">
    <h2 class="mb-4">Publicar nuevo proyecto de horas sociales</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('proyectos.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título del proyecto</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título del proyecto" required>
                </div>
               
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción del proyecto</label>
                    <textarea id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
                </div>
               
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="horas" class="form-label">Horas Requeridas</label>
                        <input type="number" class="form-control" id="horas" name="horas" placeholder="Horas Requeridas" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="ubicacion" class="form-label">Ubicación</label>
                        <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ubicación" required>
                    </div>
                </div>
               
                <div class="mb-3">
                    <label for="departamento" class="form-label">Sección/Departamento</label>
                    <select class="form-select" id="departamento" name="departamento" required>
                        <option value="">Seleccionar departamento</option>
                        @foreach($departamentos as $departamento)
                        <option value="{{ $departamento->id_departamento }}">{{ $departamento->nombre_departamento }}</option>
                        @endforeach
                        @foreach($secciones as $seccion)
                        <option value="{{ $seccion->id_seccion }}">{{ $seccion->nombre_seccion }}</option>
                        @endforeach
                    </select>
                </div>
               
                <button type="submit" class="btn btn-publicar w-100" style="background-color: #800000; color: white;">Publicar Proyecto</button>
            </form>
        </div>
    </div>
</div>

<!-- Scripts de CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#descripcion'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'undo', 'redo'],
            language: 'es'
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endsection