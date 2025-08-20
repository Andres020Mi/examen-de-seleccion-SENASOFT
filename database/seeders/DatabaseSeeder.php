<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // Crear Directora de Semilleros
        User::firstOrCreate(
            ['email' => 'directora@gmail.com'],
            [
                'name' => 'Directora General',
                'password' => Hash::make('password123'),
                'role' => 'Rol_Directora_de_Semilleros',
            ]
        );

        // Crear Director de Grupo
        User::firstOrCreate(
            ['email' => 'director1@gmail.com'],
            [
                'name' => 'Director Grupo 1',
                'password' => Hash::make('password123'),
                'role' => 'Rol_Directores_de_Grupo',
            ]
        );

        // Crear Aprendiz
        User::firstOrCreate(
            ['email' => 'aprendiz1@gmail.com'],
            [
                'name' => 'Aprendiz Ejemplo',
                'password' => Hash::make('password123'),
                'role' => 'Rol_Aprendices_asociados',
            ]
        );
    }
}
