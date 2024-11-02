<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProyectoDocumento;
use App\Models\Documento;
use App\Models\Proyecto;

class ProyectoDocumentoController extends Controller
{
    // Listar todos los registros de proyectos_documentos en una vista
    public function index()
    {
        $proyectosDocumentos = ProyectoDocumento::with('documento', 'proyecto')->get();
        return view('proyectosDocumentos.index', compact('proyectosDocumentos'));
    }

    // Mostramos el formulario de creación de un nuevo registro (NEW)
    public function create()
    {
        $documentos = Documento::all();
        $proyectos = Proyecto::all();
        return view('proyectosDocumentos.create', compact('documentos', 'proyectos'));
    }

    // Guardamos un nuevo registro en la base de datos y redirigimos
    public function store(Request $request)
    {
        $request->validate([
            'id_documento' => 'required|integer|exists:documentos,id',
            'id_proyecto' => 'required|integer|exists:proyectos,id_proyecto',
        ]);

        ProyectoDocumento::create($request->all());

        // Redirigir al índice con un mensaje de éxito (que logro completarse sin errores :D)
        return redirect()->route('proyectosDocumentos.index')
                         ->with('success', 'ProyectoDocumento creado con éxito.');
    }

    // Mostramos un registro específico en una vista de detalle
    public function show($id)
    {
        $proyectoDocumento = ProyectoDocumento::with('documento', 'proyecto')->findOrFail($id);
        return view('proyectosDocumentos.show', compact('proyectoDocumento'));
    }

    // Mostramos el formulario de edición para un registro específico
    public function edit($id)
    {
        $proyectoDocumento = ProyectoDocumento::findOrFail($id);
        $documentos = Documento::all();
        $proyectos = Proyecto::all();
        return view('proyectosDocumentos.edit', compact('proyectoDocumento', 'documentos', 'proyectos'));
    }

    // Actualizamos un registro específico y redirigimos
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_documento' => 'sometimes|integer|exists:documentos,id',
            'id_proyecto' => 'sometimes|integer|exists:proyectos,id_proyecto',
        ]);

        $proyectoDocumento = ProyectoDocumento::findOrFail($id);
        $proyectoDocumento->update($request->all());

        return redirect()->route('proyectosDocumentos.index')
                         ->with('success', 'ProyectoDocumento actualizado con éxito.');
    }

    // Eliminamos un registro específico y redirigimos
    public function destroy($id)
    {
        $proyectoDocumento = ProyectoDocumento::findOrFail($id);
        $proyectoDocumento->delete();

        return redirect()->route('proyectosDocumentos.index')
                         ->with('success', 'ProyectoDocumento eliminado con éxito.');
    }
}
