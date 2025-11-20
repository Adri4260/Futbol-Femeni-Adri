<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partit;
use App\Models\Equip;
use App\Models\Estadi;
use Carbon\Carbon;

class PartitsSeeder extends Seeder
{
    public function run()
    {
        $equips = Equip::all();
        if ($equips->count() < 2) {
            $equips = Equip::factory()->count(18)->create();
        }

        $estadis = Estadi::all();
        if ($estadis->isEmpty()) {
            $estadis = Estadi::factory()->count(5)->create();
        }

        // Exemple molt simple: crear 20 partits aleatoris
        for ($i = 0; $i < 20; $i++) {
            $local = $equips->random();
            $visitant = $equips->where('id', '!=', $local->id)->random();
            Partit::create([
                'local_id' => $local->id,
                'visitant_id' => $visitant->id,
                'estadi_id' => $estadis->random()->id,
                'data' => Carbon::now()->addDays(rand(-30, 90))->format('Y-m-d'),
                'jornada' => rand(1, 38),
                'resultat' => (rand(0, 1) ? rand(0, 4) . '-' . rand(0, 4) : null),
            ]);
        }
    }
}
