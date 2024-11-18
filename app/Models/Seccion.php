<?php

namespace App\Models;
use App\Models\Departamento; 
use Illuminate\Database\Eloquent\Model;


class Seccion extends Model 
{
    protected $perPage = 20;

    protected $table = 'secciones';
    protected $primaryKey = 'id_seccion';

    protected $fillable = ['nombre_seccion', 'id_departamento', 'id_coordinador'];

    /**
     * Define una relación que pertenece al modelo Departamento.
     */
    

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

}