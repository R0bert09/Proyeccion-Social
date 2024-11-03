<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialCambiosEstado extends Model
{
    use HasFactory;

    protected $fillable = [
        'estado_id',
        'nuevo_estado',
        'fecha_cambio',
    ];
}

