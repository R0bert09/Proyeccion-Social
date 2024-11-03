<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\HistorialCambiosEstado;
use Illuminate\Http\Request;
use App\Notifications\EstadoCambiado;

class EstadoController extends Controller
{
    private $transiciones = [
        'pendiente' => ['en_proceso', 'cancelado'],
        'en_proceso' => ['completado', 'cancelado'],
        'completado' => [],
        'cancelado' => []
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
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

        Estado::crearEstado($data);
        return redirect()->route('estado.index')->with('success', 'Estado creado con éxito');  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $estado = Estado::find($id);
        return view("estado.show", compact('estado')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $estado = Estado::find($id); 

        if (!$estado) {
            return redirect()->route('estado.index')->with('error', 'Estado no encontrado');
        }
        return view("estado.edit", compact('estado')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre_estado' => 'required|string|max:50',
        ]);
    
        $estado = Estado::find($id);
    
        if (!$estado) {
            return redirect()->route('estado.index')->with('error', 'Estado no encontrado');
        }
    
        $estado->update($data);
        return redirect()->route('estado.index')->with('success', 'Estado actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $estado = Estado::find($id);
        if (!$estado) {
            return redirect()->route('estado.index')->with('error', 'Estado no encontrado');
        }
        
        $estado->delete(); 
        return redirect()->route('estado.index')->with('success', 'Estado eliminado con éxito');
    }
    public function cambiarEstado(Request $request, $id)
    {
        $request->validate([
            'nuevo_estado' => 'required|string|max:50'
        ]);

        $nuevoEstado = $request->input('nuevo_estado');
        $estado = Estado::find($id);

        if (!$estado) {
            return response()->json(['message' => 'Estado no encontrado'], 404);
        }

        if (!isset($this->transiciones[$estado->nombre_estado]) ||
            !in_array($nuevoEstado, $this->transiciones[$estado->nombre_estado])) {
            return response()->json(['message' => 'Transición de estado no permitida'], 400);
        }

        HistorialCambiosEstado::create([
            'estado_id' => $estado->id_estado,
            'estado_anterior' => $estado->nombre_estado,
            'nuevo_estado' => $nuevoEstado,
        ]);

        $estado->nombre_estado = $nuevoEstado;
        $estado->save();

        return response()->json([
            'success' => true,
            'message' => 'Estado cambiado con éxito',
            'estado' => $estado
        ], 200);
    }


    public function mostrarCambioEstado($id)
    {
        $estado = Estado::find($id);

        if (!$estado) {
            return response()->json(['message' => 'Estado no encontrado'], 404);
        }

        $estadosPermitidos = $this->transiciones[$estado->nombre_estado] ?? [];

        return view('estado', compact('estado', 'estadosPermitidos'));
    }
    public function mostrarHistorial()
    {
        $historial = HistorialCambiosEstado::all();
        return view('estado.historial', compact('historial'));
    }


}