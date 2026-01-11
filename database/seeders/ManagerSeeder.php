<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Equip;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ManagerSeeder extends Seeder
{
    public function run(): void
    {
        // Obtenemos todos los equipos
        $equips = Equip::all();

        foreach ($equips as $equip) {
            // Comprobamos si ya tiene manager para no duplicar
            if (!$equip->manager) {
                User::create([
                    'name' => 'Manager ' . $equip->nom,
                    // Creamos un email tipo: manager_fc-barcelona@futbolfemeni.com
                    'email' => 'manager_' . Str::slug($equip->nom) . '@futbolfemeni.com',
                    'password' => Hash::make('password'), // Password genérica
                    'role' => 'manager',
                    'team_id' => $equip->id,
                ]);
            }
        }
    }
}
