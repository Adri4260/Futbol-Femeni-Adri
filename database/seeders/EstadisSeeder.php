<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estadi;
use App\Models\Equip;

class EstadisSeeder extends Seeder
{
    public function run()
    {
        $equips = Equip::all();
        if ($equips->isEmpty()) {
            $equips = Equip::factory()->count(5)->create();
        }

        Estadi::factory()->count(8)->create()->each(function ($estadi) use ($equips) {
            $estadi->equip_principal_id = $equips->random()->id;
            $estadi->save();
        });
    }
}
