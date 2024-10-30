<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaEstudiante extends Model
{
    use HasFactory;

    protected $table = 'materia_estudiantes';

    protected $fillable = ['estudiante_id', 'estado_de_materia', 'materia_id', 'fecha'];

    public function estudiantes()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }

    public function materias()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }
}
