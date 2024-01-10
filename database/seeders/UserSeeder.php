<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Daniel',
            'nickname' => 'DaniDiaz',
            'biografia' => 'Programador de Dailog',
            'email' => 'danidiazab@hotmail.com',
            'password' => bcrypt('12345678'),
            'is_perfil_publico' => 1,
            'fecha_nacimiento' => '1996-09-23',
            'rol' => 'admin',

        ]);
        $user = User::factory(5)->create();
    }
}
