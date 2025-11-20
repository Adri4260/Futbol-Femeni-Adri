<?php

namespace Database\Factories;

use App\Models\Estadi;
use App\Models\Equip;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstadiFactory extends Factory
{
    protected $model = Estadi::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->streetName . ' Stadium',
            'ciutat' => $this->faker->city,
            'capacitat' => $this->faker->numberBetween(2000, 60000),
            'equip_principal_id' => Equip::factory(),
        ];
    }
}
