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
}