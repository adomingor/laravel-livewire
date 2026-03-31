<?php

namespace Database\Factories;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'producto' => fake()->words(3, true),
            'descripcion' => fake()->sentence(),
            'activo' => fake()->boolean(),
            'id_users' => User::factory(),
            'fecha_ins' => now(),
            'fecha_upd' => now(),
        ];
    }
}
