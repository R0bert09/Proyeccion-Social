<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeeder extends Seeder
{
    public function run()
    {
        Estado::insert([
            ['nombre_estado' => 'Pendiente'],
            ['nombre_estado' => 'En Proceso'],
            ['nombre_estado' => 'Completado'],
            ['nombre_estado' => 'Cancelado'],
            ['nombre_estado' => 'Rechazado'],
            ['nombre_estado' => 'Aprobado'],
            ['nombre_estado' => 'En Espera'],
            ['nombre_estado' => 'Inactivo'],
            ['nombre_estado' => 'Activo'],
            ['nombre_estado' => 'Finalizado'],
        ]);
    }
}

