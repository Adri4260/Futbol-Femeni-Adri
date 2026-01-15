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
        $equips = Equip::all();

        foreach ($equips as $equip) {
            if (!$equip->manager) {
                User::create([
                    'name' => 'Manager ' . $equip->nom,
                    'email' => 'manager_' . Str::slug($equip->nom) . '@futbolfemeni.com',
                    'password' => Hash::make('password'),
                    'role' => 'manager',
                    'team_id' => $equip->id,
                ]);
            }
        }
    }
}
