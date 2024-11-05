<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialEstado extends Model
{
    use HasFactory;

    protected $fillable = [
        'proyecto_id',
        'estado_anterior',
        'estado_nuevo',
        'fecha_cambio',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
