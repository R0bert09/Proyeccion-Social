<?php
namespace App\Http\Controllers;


use App\Models\Proyecto;
use App\Models\Seccion;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Departamento;
use App\Models\User;

class ProyectoController extends Controller
{
    public function index()
    {
        //$proyectos = Proyecto::with(['seccion.departamento'])->where('estado', 1)->get();
        //return view('proyecto.proyecto-disponible', compact('proyectos'));
    }

    public function create()
    {
        return view("Proyecto.createProyecto");
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
    $validatedData = $request->validate([
        '' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'horas' => 'required|integer|min:1',
        'ubicacion' => 'required|string|max:255',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
    ]);

    try {
        // Crear el nuevo proyecto
        $proyecto = new Proyecto();
        $proyecto->nombre_proyecto = $validatedData['titulo'];
        $proyecto->descripcion_proyecto = $validatedData['descripcion'];
        $proyecto->horas_requeridas = $validatedData['horas'];
        $proyecto->lugar = $validatedData['ubicacion'];
        $proyecto->fecha_inicio = $validatedData['fecha_inicio'];
        $proyecto->fecha_fin = $validatedData['fecha_fin'];
        $proyecto->estado = 1; // Estado inicial
        $proyecto->periodo = now()->format('Y-m');
        $proyecto->coordinador = auth()->id();
        $proyecto->tutor = null; // Agregamos esta línea para establecer el tutor como null inicialmente
        
        $proyecto->save();

        return redirect()->back()->with('success', 'Proyecto creado exitosamente');

    } catch (\Exception $e) {
        \Log::error('Error al crear proyecto: ' . $e->getMessage());
        return redirect()->back()
            ->withInput()
            ->with('error', 'Error al crear el proyecto. Por favor intente nuevamente.');
    }
    }

    public function show(string $id)
    {
        $proyecto = Proyecto::find($id);
        return view('proyecto.proyecto_disponible', compact('proyecto'));
    }

    public function edit(string $id)
    {
        $proyecto = Proyecto::find($id);

        if (!$proyecto) {
            return redirect()->route('proyectos.index')->with('error', 'Proyecto no encontrado');
        }
        return view("Proyecto.editProyecto", compact('proyecto'));
    }

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
            return redirect()->route('proyectos.index')->with('error', 'Proyecto no encontrado');
        }

        $proyecto->update($data);
        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado con éxito');
    }

    public function destroy(string $id)
    {
        $proyecto = Proyecto::find($id);
        if (!$proyecto) {
            return redirect()->route('proyectos.index')->with('error', 'Proyecto no encontrado');
        }

        $proyecto->delete();
        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado con éxito');
    }

    public function filtrarProyectos(Request $request)
    {
        $estado = $request->input('estado');
        $periodo = $request->input('periodo');
        $query = Proyecto::query();

        if ($estado) {
            $query->where('estado', $estado);
        }

        if ($periodo) {
            $query->where('periodo', $periodo);
        }

        $ListProyecto = $query->get();

        return view("Proyecto.indexProyecto", compact("ListProyecto"));
    }

    public function asignarResponsable(Request $request, $id)
    {
        $data = $request->validate([
            'coordinador' => 'required|integer|exists:usuarios,id',
        ]);

        $proyecto = Proyecto::find($id);
        if (!$proyecto) {
            return redirect()->route('proyectos.index')->with('error', 'Proyecto no encontrado');
        }

        $proyecto->update(['coordinador' => $data['coordinador']]);
        return redirect()->route('proyectos.index')->with('success', 'Responsable asignado con éxito');
    }

    public function generarInforme()
    {
        $proyectos = Proyecto::all();
        $pdf = Pdf::loadView('test', compact('proyectos'));
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
            ->leftJoin('Asignaciones as a', function ($join) {
                $join->on('e.id_estudiante', '=', 'a.id_estudiante')
                    ->on('a.id_proyecto', '=', 'p.id_proyecto');
            })
            ->orderBy('e.nombre')
            ->get();

        return view('Proyecto.reporteProgreso', compact('resultados'));
    }

    public function createform()
    {
        return view('Proyecto.createForm');
    }

    public function storedate(Request $request)
    {
        $validatedData = $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        Proyecto::asignarFechas($validatedData);
        return redirect()->route('proyectos.index')->with('success', 'Fechas asignadas exitosamente.');
    }

    // Método para mostrar los proyectos disponibles
    public function proyectos_disponibles()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a los proyectos disponibles.');
        }
    
        // Filtrar proyectos con estado 1 (disponible)
        $proyectos = Proyecto::where('estado', 1)->get();
    
        // Verifica si la consulta devolvió resultados
        if ($proyectos->isEmpty()) {
            // Opcional: Muestra un mensaje en la vista si no hay proyectos disponibles
            return view('proyecto.proyecto_disponible', ['proyectos' => collect()]);
        }
    
        // Retorna la vista con los proyectos disponibles
        return view('proyecto.proyecto_disponible', compact('proyectos'));
    }

    public function retornar_departamentos()
    {
        $departamentos = Departamento::all();
        $secciones = Seccion::all();
        return view("proyecto.publicar-proyecto", compact('departamentos', 'secciones'));

    }
}

