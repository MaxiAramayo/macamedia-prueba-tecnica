<?php

namespace Database\Seeders;

use App\Models\Carrera;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarrerasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Carrera::create(['nombre' => 'Ingeniería en Sistemas', 'duracion' => 5]);
        Carrera::create(['nombre' => 'Contador Público', 'duracion' => 3]);
        Carrera::create(['nombre' => 'Licenciatura en Marketing', 'duracion' => 2]);
    }
}
