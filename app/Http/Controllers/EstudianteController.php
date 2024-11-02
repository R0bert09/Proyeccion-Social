<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    
    public function index(Request $request)
    {
      
        $query = $request->input('query');

      
        if ($query) {
            $ListEstudiantes = Estudiante::where('nombre', 'LIKE', "%{$query}%")
                ->orWhereHas('seccion', function ($q) use ($query) {
                    $q->where('nombre', 'LIKE', "%{$query}%");
                })
                ->get();
        } else {
            $ListEstudiantes = Estudiante::all();
        }

        return view("estudiante.index", compact("ListEstudiantes")); 
    }

   
    public function create()
    {
        return view("estudiante.create"); 
    }

  
    public function store(Request $request)
    {
       
        $data = $request->validate([
            'id_usuario' => 'required|integer|exists:users,id',
            'id_seccion' => 'required|integer|exists:secciones,id',
            'porcentaje_completado' => 'required|numeric|min:0|max:100',
            'horas_sociales_completadas' => 'required|integer|min:0',
            'nombre' => 'required|string|max:255', 
        ]);

        Estudiante::create($data);

        return redirect()->route('estudiante.index')->with('success', 'Estudiante creado con éxito');  
    }

    
    public function show(string $id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return redirect()->route('estudiante.index')->with('error', 'Estudiante no encontrado');
        }

        return view("estudiante.show", compact('estudiante')); 
    }

   
    public function edit(string $id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return redirect()->route('estudiante.index')->with('error', 'Estudiante no encontrado');
        }

        return view("estudiante.edit", compact('estudiante')); 
    }

  
    public function update(Request $request, string $id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return redirect()->route('estudiante.index')->with('error', 'Estudiante no encontrado');
        }

        
        $data = $request->validate([
            'id_usuario' => 'required|integer|exists:users,id',
            'id_seccion' => 'required|integer|exists:secciones,id',
            'porcentaje_completado' => 'required|numeric|min:0|max:100',
            'horas_sociales_completadas' => 'required|integer|min:0',
            'nombre' => 'required|string|max:255', 
        ]);

        $estudiante->update($data);

        return redirect()->route('estudiante.index')->with('success', 'Estudiante actualizado con éxito');
    }

    public function destroy(string $id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return redirect()->route('estudiante.index')->with('error', 'Estudiante no encontrado');
        }

        $estudiante->delete();

        return redirect()->route('estudiante.index')->with('success', 'Estudiante eliminado con éxito');
    }
}

