<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ListProyecto = Proyecto::all();
        return view("Proyecto.indexProyecto", compact("ListProyecto"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Proyecto.createProyecto");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_proyecto' => 'required|string|max:255',
            'estado' => 'required|integer',
            'periodo' => 'required|string|max:255',
            'lugar' => 'required|string|max:255',
            'coordinador' => 'required|integer',
        ]);
    
        Proyecto::crearProyecto($data);
        return redirect()->route('proyecto.index')->with('success', 'Proyecto creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proyecto = Proyecto::find($id);
        return view('Proyecto.showProyecto', compact('proyecto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $proyecto = Proyecto::find($id); 

        if (!$proyecto) {
            return redirect()->route('proyecto.index')->with('error', 'Proyecto no encontrado');
        }
        return view("Proyecto.editProyecto", compact('proyecto')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre_proyecto' => 'required|string|max:255',
            'estado' => 'required|integer',
            'periodo' => 'required|string|max:255',
            'lugar' => 'required|string|max:255',
            'coordinador' => 'required|integer',
        ]);
    
        $proyecto = Proyecto::find($id);
    
        if (!$proyecto) {
            return redirect()->route('proyecto.index')->with('error', 'Proyecto no encontrado');
        }
    
        $proyecto->update($data);
        return redirect()->route('proyecto.index')->with('success', 'Proyecto actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proyecto = Proyecto::find($id);
        if (!$proyecto) {
            return redirect()->route('proyecto.index')->with('error', 'Proyecto no encontrado');
        }
        
        $proyecto->delete(); 
        return redirect()->route('proyecto.index')->with('success', 'Proyecto eliminado con éxito');
    }
    /*pruebitas*/ 
    

    public function generarInforme()
    {
        $proyectos = Proyecto::all(); // Obtenemos todos los proyectos

        // Cargar la vista y pasarle los datos de los proyectos
        $pdf = Pdf::loadView('test', compact('proyectos'));

        // Retornar el PDF para descarga
        return $pdf->download('informe_progreso.pdf');
    }

    public function reporteProgreso()
    {
        $resultados = DB::table('Estudiantes as e')
        ->select(
            'e.id_estudiante',
            'e.nombre as nombre_estudiante',
            'p.nombre_proyecto',
            'e.porcentaje_completado as progreso_proyecto',
            'hs.horas_completadas as horas_sociales',
            'p.estado as estado_proyecto',
            'a.fecha_asignacion'
        )
        ->join('proyectos_estudiantes as pe', 'e.id_estudiante', '=', 'pe.id_estudiantes')
        ->join('Proyectos as p', 'pe.id_proyectos', '=', 'p.id_proyecto')
        ->leftJoin('Horas_Sociales as hs', 'e.id_estudiante', '=', 'hs.id_estudiante')
        ->leftJoin('Asignaciones as a', function($join) {
            $join->on('e.id_estudiante', '=', 'a.id_estudiante')
                 ->on('a.id_proyecto', '=', 'p.id_proyecto');
        })
        ->orderBy('e.nombre')
        ->get();
        return view('', compact('resultados'));
    }
    
    public function createform()
    {
        return view('');
    }

    public function storedate(Request $request)
    {
        $validatedData = $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);
        Proyecto::AsignarFeechas($validatedData);

        return redirect()->route('proyectos.store')->with('success', 'Fechas asignadas exitosamente.');
    }
}
