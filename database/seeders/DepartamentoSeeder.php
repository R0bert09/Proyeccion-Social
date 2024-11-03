<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Departamento::factory()->create([
            'nombre_departamento' => 'Agronomía',
        ]);
        Departamento::factory()->create([
            'nombre_departamento' => 'Economía',
        ]);
        Departamento::factory()->create([
            'nombre_departamento' => 'Humanidades',
        ]);
        Departamento::factory()->create([
            'nombre_departamento' => 'Ingeniería y Arquitectura',
        ]);
        Departamento::factory()->create([
            'nombre_departamento' => 'Jurisprudencia',
        ]);        
        Departamento::factory()->create([
            'nombre_departamento' => 'Medicina',
        ]);
        Departamento::factory()->create([
            'nombre_departamento' => 'Ciencias Naturales y Matemática',
        ]);
        Departamento::factory()->create([
            'nombre_departamento' => 'Química y Farmacia',
        ]);
     }
}
