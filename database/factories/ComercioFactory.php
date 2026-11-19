<?php

namespace Database\Factories;

use App\Models\Comercio;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comercio>
 */
class ComercioFactory extends Factory
{
    protected $model = Comercio::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'nombre_comercio' => fake()->company(),
            'rubro' => fake()->word(),
            'telefono' => fake()->numerify('########'),
        ];
    }
}
