<?php

namespace Database\Seeders;

use App\Models\HorasSociales;
use App\Models\ProyectosEstudiantes;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(RoleSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(EstudianteSeeder::class);
        $this->call(EstadosSeeder::class);
        $this->call(DepartamentoSeeder::class);
        $this->call(SeccionSeeder::class);
        $this->call(AsignacionesSeeder::class);
        $this->call(HorasSociales::class);
        $this->call(NotificacionesSeeder::class);
        $this->call(ProyectosDocumentosSeeder::class);
        $this->call(ProyectosEstudiantes::class);

    }
}
