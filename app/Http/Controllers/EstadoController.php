<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\HistorialEstado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    private $transiciones = [
        'pendiente' => ['en_proceso', 'cancelado', 'rechazado'],
        'en_proceso' => ['completado', 'cancelado', 'rechazado'],
        'completado' => [],
        'cancelado' => [],
        'rechazado' => []
    ];

    /**
     * Verificar si una transición de estado es válida.
     */
    private function puedeTransicionar($estadoActual, $nuevoEstado)
    {
        return in_array($nuevoEstado, $this->transiciones[$estadoActual]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ListEstados = Estado::all();
        return view("estado.index", compact("ListEstados")); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("estado.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_estado' => 'required|string|max:50',
        ]);

        // Estandarización del nombre
        $data['nombre_estado'] = ucfirst(strtolower($data['nombre_estado']));

        Estado::crearEstado($data);
        return redirect()->route('estado.index')->with('success', 'Estado creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $estado = Estado::find($id);
        return view("estado.show", compact('estado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function mostrarCambiarEstado($id)
    {
        $estado = Estado::find($id);

        if (!$estado) {
            return redirect()->route('estado.index')->with('error', 'Estado no encontrado');
        }
        return view("estado.edit", compact('estado'))->with('success', 'Estado encontrado');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $estado = Estado::find($id);

    if (!$estado) {
        return redirect()->route('estado.index')->with('error', 'Estado no encontrado');
    }

    $estadoAnterior = $estado->nombre_estado;

    $request->validate([
        'nuevo_estado' => 'required|string|in:' . implode(',', $this->transiciones[$estadoAnterior] ?? []),
    ]);

    $estado->nombre_estado = $request->input('nuevo_estado');
    $estado->save();

    HistorialEstado::create([
        'proyecto_id' => $estado->proyecto_id,
        'estado_anterior' => $estadoAnterior,
        'estado_nuevo' => $estado->nombre_estado,
    ]);

    return redirect()->route('estado.index')->with('success', 'Estado actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $estado = Estado::find($id);
        if (!$estado) {
            return redirect()->route('estado.index')->with('error', 'Estado no encontrado');
        }

        $estado->delete();
        return redirect()->route('estado.index')->with('success', 'Estado eliminado con éxito');
    }
}
