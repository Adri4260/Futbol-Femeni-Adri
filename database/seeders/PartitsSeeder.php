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
        if ($equips->count() < 10) {
            $equips = Equip::factory()->count(18)->create();
        }

        $estadis = Estadi::all();
        if ($estadis->count() < 5) {
            $estadis = Estadi::factory()->count(5)->create();
        }

        $dates = collect();
        $today = Carbon::today();

        for ($i = 0; $i < 60; $i++) {
            $local = $equips->random();
            $visitant = $equips->where('id', '!=', $local->id)->random();

            $date = $today->copy()->addDays(rand(-30, 90));
            while ($dates->contains("{$local->id}-{$visitant->id}-{$date->toDateString()}")) {
                $date->addDays(rand(0, 7));
            }
            $dates->push("{$local->id}-{$visitant->id}-{$date->toDateString()}");

            Partit::create([
                'local_id' => $local->id,
                'visitant_id' => $visitant->id,
                'estadi_id' => $estadis->random()->id,
                'data' => $date->format('Y-m-d'),
                'jornada' => rand(1, 38),
                'resultat' => rand(0, 1) ? rand(0, 5) . '-' . rand(0, 5) : null,
            ]);
        }
    }
}
