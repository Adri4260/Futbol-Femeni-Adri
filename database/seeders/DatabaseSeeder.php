<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            EquipsSeeder::class,
            EstadisSeeder::class,
            JugadoresSeeder::class,
            PartitsSeeder::class,
            UserSeeder::class,
        ]);
    }
}
