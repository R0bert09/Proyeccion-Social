<form action="{{ route('estado.cambiar', $estado->id) }}" method="POST">
    @csrf
    <label for="nuevo_estado">Selecciona un nuevo estado:</label>
    <select name="nuevo_estado" id="nuevo_estado">
        <option value="pendiente">Pendiente</option>
        <option value="en_proceso">En Proceso</option>
        <option value="completado">Completado</option>
        <option value="cancelado">Cancelado</option>
        <option value="rechazado">Rechazado</option>
    </select>
    <button type="submit">Cambiar Estado</button>
</form>
