<?php

namespace Database\Factories;

use App\Models\Carrera;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estudiante>
 */
class EstudianteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'nombre' => $this->faker->firstName(), // Nombre aleatorio
            'apellido' => $this->faker->lastName(), // Apellido aleatorio
            'email' => $this->faker->unique()->safeEmail(), // Email único
            'dni' => $this->faker->unique()->numberBetween(10000000, 99999999), // DNI único
            'telefono' => $this->faker->phoneNumber(), // Teléfono aleatorio
            'numero_legajo' => $this->faker->unique()->numberBetween(1000, 9999), // Número de legajo único
            'estado' => $this->faker->randomElement(['activo', 'inactivo']), // Estado aleatorio
            'carrera_id' => Carrera::all()->random()->id, // Elegir una carrera existente aleatoriamente
        ];
    }
}
