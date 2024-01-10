<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Amigo>
 */
class AmigoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id_uno' => User::all()->random()->id,
            'user_id_dos' => User::all()->random()->id,
            'estado_peticion' => $this->faker->randomElement([0, 1]),
            
        ];
    }
}
