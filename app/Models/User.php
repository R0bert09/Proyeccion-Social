<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;

    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    
    public function seccionesCoordinadas()
    {
        return $this->hasMany(Seccion::class, 'id_coordinador');
    }

    // Secciones donde es tutor
    public function seccionesTutoreadas()
    {
        return $this->belongsToMany(
            Seccion::class,
            'seccion_tutor',
            'id_tutor',
            'id_seccion'
        );
    }

    public function scopeEstudiantesPorSeccion(Builder $query)
    {
        return $query->role('estudiante')
            ->leftJoin('estudiantes', 'users.id_usuario', '=', 'estudiantes.id_usuario')
            ->leftJoin('secciones', 'estudiantes.id_seccion', '=', 'secciones.id_seccion')
            ->orderBy('secciones.id_seccion')
            ->select('users.', 'secciones.nombre_seccion');
    }

    public function scopeTutoresPorSeccion(Builder $query)
    {
        return $query->role('tutor')
            ->leftJoin('seccion_tutor', 'users.id_usuario', '=', 'seccion_tutor.id_tutor')
            ->leftJoin('secciones', 'seccion_tutor.id_seccion', '=', 'secciones.id_seccion')
            ->orderBy('secciones.id_seccion')
            ->select('users.', 'secciones.nombre_seccion')
            ->distinct();
    }

    public function scopeCoordinadoresPorSeccion(Builder $query)
    {
        return $query->role('coordinador')
            ->leftJoin('secciones', 'users.id_usuario', '=', 'secciones.id_coordinador')
            ->orderBy('secciones.id_seccion')
            ->select('users.*', 'secciones.nombre_seccion');
    }

    public function scopeAdministradoresPorSeccion(Builder $query)
{
    return $query->role('administrador')
        ->select('users.*')
        ->orderBy('users.name');
}

    public static function UsuariosPorSeccion()
    {
        $estudiantes = self::estudiantesPorSeccion()->get();
        $tutores = self::tutoresPorSeccion()->get();
        $coordinadores = self::coordinadoresPorSeccion()->get();
        $administradores = self::AdministradoresPorSeccion()->get();

        return [
            'estudiantes' => $estudiantes,
            'tutores' => $tutores,
            'coordinadores' => $coordinadores,
            'administradores' => $administradores
        ];
    }
}

