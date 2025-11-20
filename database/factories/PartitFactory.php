<?php

namespace Database\Factories;

use App\Models\Partit;
use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartitFactory extends Factory
{
    protected $model = Partit::class;

    public function definition()
    {
        $local = Equip::factory();
        $visitant = Equip::factory();
        return [
            'local_id' => $local,
            'visitant_id' => $visitant,
            'estadi_id' => Estadi::factory(),
            'data' => $this->faker->dateTimeBetween('+1 days', '+1 year')->format('Y-m-d'),
            'jornada' => $this->faker->numberBetween(1, 38),
            'resultat' => null,
        ];
    }
}
