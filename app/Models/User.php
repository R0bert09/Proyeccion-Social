<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

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
}
