<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'categoria' => fake()->word(),
            'activo' => fake()->boolean(),
            'id_users' => User::factory(),
            'fecha_ins' => now(),
            'fecha_upd' => now(),
        ];
    }
}
