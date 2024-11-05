<?php

namespace App\Http\Controllers;

use App\Models\HistorialEstado;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    protected $historialEstado;

    public function __construct()
    {
        $this->historialEstado = new HistorialEstado();
    }

    public function index()
    {
        $historial = $this->historialEstado->all();
        return view('historial.index', compact('historial'));
    }

    /*
    * se necesita la tabla para ir guardando el horial delestado
    */
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'proyecto_id' => 'required|integer',
            'estado_anterior' => 'required|string',
            'estado_nuevo' => 'required|string',
        ]);

        $this->historialEstado->create($data);

        return redirect()->route('historial.index')->with('success', 'Cambio de estado registrado con éxito');
    }
}

