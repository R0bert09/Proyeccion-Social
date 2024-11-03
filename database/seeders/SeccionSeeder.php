<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seccion;

use function Ramsey\Uuid\v1;

class SeccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    Seccion::factory()->create([
        'nombre_seccion' => 'Administración de Empresas',
        'id_departamento' => 2,
    ]);
    Seccion::factory()->create([
        'nombre_seccion' => 'Agronomía',
        'id_departamento' => 1,
    ]);
    Seccion::factory()->create([
        'nombre_seccion' => 'Arquitectura',
        'id_departamento' => 4,
    ]);
    Seccion::factory()->create([
        'nombre_seccion' => 'Biología',
        'id_departamento' => 7,
    ]);
    Seccion::factory()->create([
        'nombre_seccion' => 'Ciencias Químicas',
        'id_departamento' => 7,
    ]);
    Seccion::factory()->create([
        'nombre_seccion' => 'Contaduría pública',
        'id_departamento' => 2,
    ]);
    Seccion::factory()->create([
        'nombre_seccion' => 'Educación',
        'id_departamento' => 3,
    ]);
    Seccion::factory()->create([
        'nombre_seccion' => 'Física',
        'id_departamento' => 7,
    ]);
    Seccion::factory()->create([
        'nombre_seccion' => 'Idiomas',
        'id_departamento' => 3,
    ]);
    Seccion::factory()->create([
        'nombre_seccion' => 'Ingeniería Civil',
        'id_departamento' => 4,
    ]);    
    Seccion::factory()->create([
        'nombre_seccion' => 'Ingeniería de Sistemas Informáticos',
        'id_departamento' => 4,
    ]);    
    Seccion::factory()->create([
        'nombre_seccion' => 'Ingeniería Industrial',
        'id_departamento' => 4,
    ]);    
    Seccion::factory()->create([
        'nombre_seccion' => 'Jurisprudencia y Ciencias Sociales',
        'id_departamento' => 5,
    ]);
    Seccion::factory()->create([
        'nombre_seccion' => 'Letras',
        'id_departamento' => 3,
    ]);
    Seccion::factory()->create([
        'nombre_seccion' => 'Lic. en Laboratorio Clínico',
        'id_departamento' => 6,
    ]);
    Seccion::factory()->create([
        'nombre_seccion' => 'Matemática',
        'id_departamento' => 7,
    ]);
    Seccion::factory()->create([
        'nombre_seccion' => 'Mercadeo Internacional',
        'id_departamento' => 2,
    ]);
    
    Seccion::factory()->create([
        'nombre_seccion' => 'Psicología',
        'id_departamento' => 3,
    ]);
    Seccion::factory()->create([
        'nombre_seccion' => 'Sociología',
        'id_departamento' => 3,
    ]);

    }
}
