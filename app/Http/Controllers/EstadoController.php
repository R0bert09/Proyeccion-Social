<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\HistorialCambiosEstado;
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
     * Display a listing of the resource.
     */
    public function index()
    {
        $estadosPermitidos = ['pendiente', 'en_proceso', 'completado', 'cancelado', 'rechazado'];
        $ListEstados = Estado::all();
        return view("index", compact("ListEstados",'estadosPermitidos'));
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
    public function show( $id)
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

    public function mostrarHistorial()
    {
        // Obtener todos los registros del historial de cambios
        $historial = HistorialCambiosEstado::all();
        return view('historial', compact('historial'));
    }  
    
    public function cambiarEstado(Request $request, $id)
{
    // Validar la entrada del nuevo estado
    $data = $request->validate([
        'nuevo_estado' => 'required|string|max:50',
    ]);

    // Buscar el estado por ID
    $estado = Estado::find($id);

    // Verificar si el estado existe
    if (!$estado) {
        return redirect()->route('estado.index')->with('error', 'Estado no encontrado');
    }

    // Verificar si la transición es permitida
    if (!array_key_exists($estado->nombre_estado, $this->transiciones) || 
        !in_array($data['nuevo_estado'], $this->transiciones[$estado->nombre_estado])) {
        return redirect()->route('estado.index')->with('error', 'Transición no permitida');
    }

    // Cambiar el estado al nuevo estado
    $estado->nombre_estado = $data['nuevo_estado'];
    $estado->save();

    // Registrar el cambio en el historial de cambios de estado
    HistorialCambiosEstado::create([
        'estado_id' => $estado->id,
        'nuevo_estado' => $data['nuevo_estado'],
        'fecha_cambio' => now(), // O la fecha y hora actual
    ]);

    return redirect()->route('estado.index')->with('success', 'Estado cambiado con éxito');
}

    
    

}


