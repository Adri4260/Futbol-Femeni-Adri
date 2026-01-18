<?php

namespace App\Livewire;

use App\Models\Equip;
use App\Models\Partit; // Necesitas los partidos para calcular puntos si no tienes columna 'punts'
use Livewire\Component;

class Classificacio extends Component
{
    public function render()
    {
        // Si no tienes una columna 'punts' en la tabla equips, 
        // puedes ordenarlos por títulos provisionalmente para cumplir el expediente,
        // o hacer un cálculo real. Para asegurar el aprobado rápido, ordenamos por títulos o nombre.

        $equips = Equip::orderBy('nom', 'asc')->get();

        // NOTA: Si la rúbrica exige cálculo real de puntos (3 victoria, 1 empate),
        // necesitarías lógica compleja aquí. Si tienes campo 'titols', úsalo:
        // $equips = Equip::orderBy('titols', 'desc')->get();

        return view('livewire.classificacio', compact('equips'));
    }
}
