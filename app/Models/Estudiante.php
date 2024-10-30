<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';

    protected $fillable = ['nombre', 'apellido', 'email', 'dni', 'telefono', 'numero_legajo', 'estado', 'carrera_id'];

    public function materias()
    {
        return $this->belongsToMany(Materia::class, 'estudiante_materia');
    }

    public function carreras()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }
}
