<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProyectoDocumento;

class ProyectoDocumentoController extends Controller
{
    // Listar todos los registros de proyectos_documentos
    public function index()
    {
        $proyectosDocumentos = ProyectoDocumento::with('documento', 'proyecto')->get();
        return response()->json($proyectosDocumentos);
    }

    // Crear un nuevo registro
    public function store(Request $request)
    {
        $request->validate([
            'id_documento' => 'required|integer|exists:documentos,id',
            'id_proyecto' => 'required|integer|exists:proyectos,id_proyecto',
        ]);

        $proyectoDocumento = ProyectoDocumento::create($request->all());
        return response()->json($proyectoDocumento, 201);
    }

    // Mostrar un registro específico
    public function show($id)
    {
        $proyectoDocumento = ProyectoDocumento::with('documento', 'proyecto')->findOrFail($id);
        return response()->json($proyectoDocumento);
    }

    // Actualizar un registro
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_documento' => 'sometimes|integer|exists:documentos,id',
            'id_proyecto' => 'sometimes|integer|exists:proyectos,id_proyecto',
        ]);

        $proyectoDocumento = ProyectoDocumento::findOrFail($id);
        $proyectoDocumento->update($request->all());

        return response()->json($proyectoDocumento);
    }

    // Eliminar un registro
    public function destroy($id)
    {
        $proyectoDocumento = ProyectoDocumento::findOrFail($id);
        $proyectoDocumento->delete();

        return response()->json(null, 204);
    }
}
