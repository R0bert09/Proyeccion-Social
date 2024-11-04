<form action="{{ route('proyectos.store') }}" method="POST">
    @csrf
    <label for="nombre_proyecto">Nombre del Proyecto:</label>
    <input type="text" name="nombre_proyecto" required>

    <label for="estado">Estado:</label>
    <select name="estado" required>
        <!-- Opciones de estado -->
    </select>

    <label for="periodo">Periodo:</label>
    <input type="text" name="periodo" required>

    <label for="lugar">Lugar:</label>
    <input type="text" name="lugar" required>

    <label for="coordinador">ID Coordinador:</label>
    <input type="number" name="coordinador" required>

    <label for="fecha_inicio">Fecha de Inicio:</label>
    <input type="date" name="fecha_inicio" required>

    <label for="fecha_fin">Fecha de Fin:</label>
    <input type="date" name="fecha_fin" required>

    <button type="submit">Crear Proyecto</button>
</form>
