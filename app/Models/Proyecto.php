<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estado;
use App\Models\Estudiante;
use App\Models\User;



class Proyecto extends Model
{
    use HasFactory;
    protected $table = 'proyectos';
    protected $primaryKey= 'id_proyecto';


    protected $fillable =
    [
        'nombre_proyecto',
        'estado',
        'periodo',
        'lugar',
        'coordinador',
        'tutor'
    ];

    //create
    public static function crearProyecto($data)
    {
        $validarCampos = validator($data, [
            'nombre_proyecto' => 'required|string|max:255',
            'estado' => 'required|integer',
            'periodo' => 'required|string|max:255',
            'lugar' => 'required|string|max:255',
            'coordinador' => 'required|integer',
            'fecha_inicio' => 'required|date',  
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ])->validate();

        return self::create($validarCampos);
    }

    //Relaciones a tabla estado y usuario
    public function estadoo()
    {
        return $this->belongsTo(Estado::class,'estado','id_estado');
    }

    public static function AsignarFeechas($data)
    {
        return self::create($data);
    }

    public function coordinadorr()
    {
        return $this->belongsTo(User::class, 'coordinador', 'id_usuario');
    }

    public function tutorr()
    {
        return $this->belongsTo(User::class,'tutor','id_usuario');
    }   

    //gets
    public function getProyecto_porId($id)
    {
        return self::with('estado', 'coordinador')->find($id);
    }
    public function getProyecto_porNombre_estudiante($nombre_estudiante)
    {
        return self::with('estado', 'coordinador')->where('nombre_proyecto', $nombre_estudiante)->first();
    }
    public function getProyectos_porEstado($estadoId)
    {
        return self::with('estado', 'coordinador')->where('estado', $estadoId)->get();
    }
    public function getProyectos_porCoordinador($coordinadorId)
    {
        return self::with('estado', 'coordinador')->where('coordinador', $coordinadorId)->get();
    }
    public function getProyectos_porPeriodo($periodo)
    {
        return self::with('estado', 'coordinador')->where('periodo', $periodo)->get();
    }
    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'proyectos_estudiantes', 'id_proyecto', 'id_estudiante');
    }
}
