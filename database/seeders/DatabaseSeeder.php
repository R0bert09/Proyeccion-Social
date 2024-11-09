<?php

namespace Database\Seeders;

use App\Models\Asignacion;
use App\Models\Departamento;
use App\Models\Documento;
use App\Models\Estado;
use App\Models\Estudiante;
use App\Models\HorasSociales;
use App\Models\Notificacion;
use App\Models\Proyecto;
use App\Models\ProyectosDocumentos;
use App\Models\ProyectosEstudiantes;
use App\Models\Seccion;
use App\Models\User;

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
