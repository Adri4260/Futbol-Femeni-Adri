<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@futbolfemeni.com',
            'password' => Hash::make('password'), // La contraseña será 'password'
            'role' => 'admin',
        ]);

        // Manager (ejemplo)
        User::create([
            'name' => 'Manager 1',
            'email' => 'manager1@futbolfemeni.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
        ]);

        // Arbitre (ejemplo)
        User::create([
            'name' => 'Arbitre 1',
            'email' => 'arbitre1@futbolfemeni.com',
            'password' => Hash::make('password'),
            'role' => 'arbitre',
        ]);
    }
}
