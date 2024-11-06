<?php

namespace Database\Seeders;

use App\Models\HorasSociales;
use App\Models\Estudiante;
use Illuminate\Database\Seeder;

class HorasSocialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estudiantes = Estudiante::all();

        if ($estudiantes->isEmpty()) {
            throw new \Exception('Debes crear estudiantes antes de llenar las horas sociales');
        }

        foreach ($estudiantes as $estudiante) {
            HorasSociales::create([
                'id_estudiante' => $estudiante->id,
                'horas_completadas' => rand(0, 500), 
                'fecha_registro' => now() 
            ]);
        }
    }
}
