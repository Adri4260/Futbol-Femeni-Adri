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
        $local = Equip::factory()->create();
        $visitant = Equip::factory()->create();

        return [
            'local_id' => $local->id,
            'visitant_id' => $visitant->id,
            'estadi_id' => Estadi::factory()->create()->id,
            'data' => $this->faker->dateTimeBetween('-30 days', '+180 days')->format('Y-m-d'),
            'jornada' => $this->faker->numberBetween(1, 38),
            'resultat' => rand(0, 1) ? rand(0, 5) . '-' . rand(0, 5) : null,
        ];
    }
}
