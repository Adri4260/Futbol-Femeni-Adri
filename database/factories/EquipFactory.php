<?php

namespace Database\Factories;

use App\Models\Equip;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipFactory extends Factory
{
    protected $model = Equip::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->unique()->company . ' Femení',
            'ciutat' => $this->faker->city,
            'lliga' => 'Lliga F',
            'escut' => null,
        ];
    }
}
