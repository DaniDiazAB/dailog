<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->sentence();

        return [
            //'titulo' => $this->faker->word(7),
            'titulo' => $name,
            'contenido' => $this->faker->text(3000),
            'slug' => Str::slug($name),
            'categoria' => $this->faker->word(7),
            'user_id' => User::all()->random()->id,  
        ];
    }
}
