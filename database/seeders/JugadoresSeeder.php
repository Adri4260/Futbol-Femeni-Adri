<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jugadora;

class JugadoresSeeder extends Seeder
{
    public function run(): void
    {
        Jugadora::factory()->count(50)->create();
    }
}
