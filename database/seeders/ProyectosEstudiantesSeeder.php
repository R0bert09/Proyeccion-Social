<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProyectosEstudiantesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('proyectos_estudiantes')->insert([
            ['id_proyectos' => 1, 'id_estudiantes' => 1],
            ['id_proyectos' => 2, 'id_estudiantes' => 2],
            ['id_proyectos' => 3, 'id_estudiantes' => 3],
            ['id_proyectos' => 4, 'id_estudiantes' => 4],
            ['id_proyectos' => 5, 'id_estudiantes' => 5],
            ['id_proyectos' => 6, 'id_estudiantes' => 6],
            ['id_proyectos' => 7, 'id_estudiantes' => 7],
            ['id_proyectos' => 8, 'id_estudiantes' => 8],
            ['id_proyectos' => 1, 'id_estudiantes' => 9],
            ['id_proyectos' => 1, 'id_estudiantes' => 10],
            ['id_proyectos' => 1, 'id_estudiantes' => 11],
            ['id_proyectos' => 1, 'id_estudiantes' => 12],
            
            
        ]);
    }
}
