<?php

namespace Database\Factories;

use App\Models\Jugadora;
use App\Models\Equip;
use Illuminate\Database\Eloquent\Factories\Factory;

class JugadoraFactory extends Factory
{
    protected $model = Jugadora::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->firstName(),
            'cognoms' => $this->faker->lastName(),
            'dorsal' => $this->faker->numberBetween(1, 99),
            'data_naixement' => $this->faker->dateTimeBetween('-35 years', '-16 years'),
            'foto' => 'default.png',
            'posicio' => $this->faker->randomElement(['Davanter', 'Defensa', 'Porter', 'Migcampista']),
            'equip_id' => Equip::inRandomOrder()->first()->id,
        ];
    }
}
