<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $table = 'materias';

    protected $fillable = ['nombre', 'carrera', 'duracion', 'horas', 'carrera_id'];

    public function carreras()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id'); //pertenece a carrera
    }
 
    public function estudiante(){
        return $this->belongsToMany(Estudiante::class, 'estudiante_materia');
    }

}
