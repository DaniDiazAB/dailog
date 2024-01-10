<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Amigo;
use App\Models\Lista;
use App\Models\Post;
use App\Models\Tipo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        Tipo::factory(3)->create();
        Post::factory(100)->create();
        Amigo::factory(10)->create();
        Lista::factory(500)->create();
    }
}
