<?php

namespace Database\Factories;

use App\Models\Prueba;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Prueba>
 */
class PruebaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'apellido' => fake()->lastName(),
            'nombre' => fake()->firstName(),
            'edad' => fake()->numberBetween(1, 99),
        ];
    }
}
