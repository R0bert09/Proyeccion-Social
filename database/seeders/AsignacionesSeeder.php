<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Estudiante;
use App\Models\Proyecto;
use App\Models\User;
use App\Models\Asignacion;
class AsignacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Obtener todos los estudiantes, proyectos y tutores
        $estudiantes = Estudiante::all();
        $proyectos = Proyecto::all();
        $tutores = User::role('Tutor')->get(); // Obtener solo los usuarios con el rol de 'Tutor'
        
        // Verificar si hay datos en las tablas necesarias
        if ($estudiantes->isEmpty() || $proyectos->isEmpty() || $tutores->isEmpty()) {
            throw new \Exception('Probablemenete no hay datos de Estudiantes, datos de Proyectos o datos de Tutor');
        }

        // Iterar sobre los estudiantes y asignarles un proyecto y tutor aleatorio
        foreach ($estudiantes as $estudiante) {
            Asignacion::create([
                'id_proyecto' => $proyectos->random()->id, // Selecciona un proyecto aleatorio
                'id_estudiante' => $estudiante->id, // ID del estudiante actual
                'id_tutor' => $tutores->random()->id, // Selecciona un tutor aleatorio
                'fecha_asignacion' => Carbon::now()->subDays(rand(0, 365))->format('d/m/Y'), // Fecha aleatoria en el ultimo año con formato dia/mes/año
            ]);
        }
         
    }
    
}
