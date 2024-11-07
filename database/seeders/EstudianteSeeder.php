<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Seccion;
use App\Models\Estudiante;

class EstudianteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            // Verificar si existen secciones
            $secciones = Seccion::all();
            
            if ($secciones->isEmpty()) {
                throw new \Exception('Debes crear secciones antes de crear estudiantes');
            }

            // Lista de estudiantes
            $estudiantes = [
                ['name' => 'Carlos Eduardo Martínez', 'email' => 'carlos.martinez@ejemplo.com'],
                ['name' => 'Andrea Michelle López', 'email' => 'andrea.lopez@ejemplo.com'],
                ['name' => 'José Alberto Ramírez', 'email' => 'jose.ramirez@ejemplo.com'],
                ['name' => 'María Fernanda Castro', 'email' => 'maria.castro@ejemplo.com'],
                ['name' => 'Daniel Alexander Pérez', 'email' => 'daniel.perez@ejemplo.com'],
                ['name' => 'Sofia Isabella Morales', 'email' => 'sofia.morales@ejemplo.com'],
                ['name' => 'Luis Fernando González', 'email' => 'luis.gonzalez@ejemplo.com'],
                ['name' => 'Ana Gabriela Mendoza', 'email' => 'ana.mendoza@ejemplo.com'],
                ['name' => 'Diego Alejandro Torres', 'email' => 'diego.torres@ejemplo.com'],
                ['name' => 'Valeria Nicole Flores', 'email' => 'valeria.flores@ejemplo.com'],
                ['name' => 'Roberto Carlos Santos', 'email' => 'roberto.santos@ejemplo.com'],
                ['name' => 'Carmen Elena Rivas', 'email' => 'carmen.rivas@ejemplo.com'],
                ['name' => 'Jorge Alberto Mejía', 'email' => 'jorge.mejia@ejemplo.com'],
                ['name' => 'Patricia Alexandra Díaz', 'email' => 'patricia.diaz@ejemplo.com'],
                ['name' => 'Eduardo José Quintanilla', 'email' => 'eduardo.quintanilla@ejemplo.com']
            ];

            // Crear estudiantes
            foreach ($estudiantes as $estudiante) {
                $usuario = User::create([
                    'name' => $estudiante['name'],
                    'email' => $estudiante['email'],
                    'password' => Hash::make('12345678'),
                    'email_verified_at' => now(),
                ]);

                // Asignar rol de estudiante
                $usuario->assignRole('Estudiante');


                Estudiante::create([
                    'id_usuario' => $usuario->id,
                    'id_seccion' => $secciones->random()->id_seccion,
                    'porcentaje_completado' => rand(0, 100),
                    'horas_sociales_completadas' => rand(0, 500),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            $this->command->info('Estudiantes creados exitosamente.');

        } catch (\Exception $e) {
            $this->command->error("Error: " . $e->getMessage());
            throw $e;
        }
    }
}
