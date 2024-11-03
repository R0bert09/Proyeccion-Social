<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proyecto;

class Estado extends Model
{
    use HasFactory;

    // Especifica la tabla que utilizará este modelo
    protected $table = 'estados';

    // Especifica la clave primaria de la tabla
    protected $primaryKey = 'id'; // Por defecto, Laravel utiliza 'id' como clave primaria

    // Especifica los atributos que se pueden llenar masivamente
    protected $fillable = [
        'nombre_estado',
    ];

    // Relaciones
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }

    // Métodos para obtener estados
    public function getEstadoPorId($id)
    {
        return self::find($id);
    }

    public function getEstados()
    {
        return self::all();
    }
}
