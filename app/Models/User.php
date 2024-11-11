<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable Implements JWTSubject 
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

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
