<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equip;

class EquipsSeeder extends Seeder
{
    public function run()
    {
        Equip::factory()->count(18)->create();
    }
}
