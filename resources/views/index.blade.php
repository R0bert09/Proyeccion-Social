<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Nombre del Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ListEstados as $estado)
            <tr>
                <td>{{ $estado->id }}</td>
                <td>{{ $estado->nombre_estado }}</td>
                <td>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#cambiarEstadoModal{{ $estado->id }}">
                        Cambiar Estado
                    </button>

                    <div class="modal fade" id="cambiarEstadoModal{{ $estado->id }}" tabindex="-1" role="dialog" aria-labelledby="cambiarEstadoModalLabel{{ $estado->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="cambiarEstadoModalLabel{{ $estado->id }}">Cambiar Estado de {{ $estado->nombre_estado }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('estado.cambiar', $estado->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <label for="nuevo_estado">Selecciona un nuevo estado:</label>
                                        <select name="nuevo_estado" id="nuevo_estado" class="form-control">
                                            @foreach ($estadosPermitidos as $nuevoEstado)
                                                <option value="{{ $nuevoEstado }}">{{ ucfirst($nuevoEstado) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Cambiar Estado</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
