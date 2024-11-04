<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estados')->insert([
            ['nombre_estado' => 'En revision'],
            ['nombre_estado' => 'Aprobados'],
            ['nombre_estado' => 'Activo'],
            ['nombre_estado' => 'Finalizado'],
        ]);
    }
}
