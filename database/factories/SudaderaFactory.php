<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sudadera>
 */
class SudaderaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'Sudadera_id' => \App\Models\Sudadera::all()->random()->id,
                'Logotipos' => ucfirst(fake()->word()),
                'Imagenes editadas' => ucfirst(fake()->word()),
                'Cantidad'=> fake()->numberBetween(1,100),
                'Fecha de entrega'=> fake()->dateTimeBetween('-1 year','now'),
                'Precio'=> fake()->randomFloat(2,10,100),
        ];
    }
}
