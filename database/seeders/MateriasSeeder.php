<?php

namespace Database\Seeders;

use App\Models\Materia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MateriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Materia::create(['nombre' => 'Programación I', 'duracion' => 'cuatrimestral', 'horas' => 60, 'carrera_id' => 1]);
        Materia::create(['nombre' => 'Estructura de Datos', 'duracion' => 'cuatrimestral', 'horas' => 60, 'carrera_id' => 1]);
        Materia::create(['nombre' => 'Matemáticas I', 'duracion' => 'cuatrimestral', 'horas' => 50, 'carrera_id' => 1]);

        Materia::create(['nombre' => 'Contabilidad General', 'duracion' => 'anual', 'horas' => 80, 'carrera_id' => 2]);
        Materia::create(['nombre' => 'Derecho Empresarial', 'duracion' => 'cuatrimestral', 'horas' => 40, 'carrera_id' => 2]);
        Materia::create(['nombre' => 'Finanzas', 'duracion' => 'cuatrimestral', 'horas' => 50, 'carrera_id' => 2]);

        Materia::create(['nombre' => 'Fundamentos de Marketing', 'duracion' => 'cuatrimestral', 'horas' => 40, 'carrera_id' => 3]);
        Materia::create(['nombre' => 'Comportamiento del Consumidor', 'duracion' => 'cuatrimestral', 'horas' => 60, 'carrera_id' => 3]);
        Materia::create(['nombre' => 'Estrategias de Marketing', 'duracion' => 'anual', 'horas' => 80, 'carrera_id' => 3]);
        Materia::create(['nombre' => 'Investigación de Mercados', 'duracion' => 'cuatrimestral', 'horas' => 50, 'carrera_id' => 3]);
    }
}
