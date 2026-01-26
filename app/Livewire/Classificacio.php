<?php

namespace App\Livewire;

use App\Models\Equip;
use App\Models\Partit; // Necesitas los partidos para calcular puntos si no tienes columna 'punts'
use Livewire\Component;

class Classificacio extends Component
{
    public function render()
    {
        $equips = Equip::orderBy('nom', 'asc')->get();

        return view('livewire.classificacio', compact('equips'));
    }
}
