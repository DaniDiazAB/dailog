<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Tipo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lista>
 */
class ListaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //'user_id_uno' => User::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'id_tipo' => Tipo::all()->random()->id,
            'id_post' => Post::all()->random()->id,
        ];
    }
}
