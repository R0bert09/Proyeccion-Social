<?php

namespace App\Http\Controllers;

use App\Models\ProyectosDocumentos;
use Illuminate\Http\Request;

class ProyectosDocumentosController extends Controller
{
    public function index()
    {
        $ProyectosDocumentoss = ProyectosDocumentos::all();
        return view('proyectos_documentos.index', compact('ProyectosDocumentoss'));
    }

    public function create()
    {
        return view('proyectos_documentos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_documento' => 'required|integer|exists:documentos,id',
            'id_proyecto' => 'required|integer|exists:proyectos,id_proyecto',
        ]);

        ProyectosDocumentos::create($request->all());
        return redirect()->route('proyectos_documentos.index')
                         ->with('success', 'ProyectosDocumentos creado exitosamente.');
    }

    public function show($id)
    {
        $ProyectosDocumentos = ProyectosDocumentos::find($id);
        return view('proyectos_documentos.show', compact('ProyectosDocumentos'));
    }

    public function edit($id)
    {
        $ProyectosDocumentos = ProyectosDocumentos::find($id);
        return view('proyectos_documentos.edit', compact('ProyectosDocumentos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_documento' => 'required|integer|exists:documentos,id',
            'id_proyecto' => 'required|integer|exists:proyectos,id_proyecto',
        ]);

        $ProyectosDocumentos = ProyectosDocumentos::find($id);
        $ProyectosDocumentos->update($request->all());
        return redirect()->route('proyectos_documentos.index')
                         ->with('success', 'ProyectosDocumentos actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $ProyectosDocumentos = ProyectosDocumentos::find($id);
        $ProyectosDocumentos->delete();
        return redirect()->route('proyectos_documentos.index')
                         ->with('success', 'ProyectosDocumentos eliminado exitosamente.');
    }
}
