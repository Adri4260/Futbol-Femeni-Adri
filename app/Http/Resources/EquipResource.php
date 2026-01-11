<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom_equip' => $this->nom, // Podemos cambiar el nombre de la clave si queremos
            'ciutat' => $this->ciutat,
            'lliga' => $this->lliga,
            // Si hay escudo, devolvemos la URL completa, si no, null
            'escut_url' => $this->escut ? asset('storage/' . $this->escut) : null,
        ];
    }
}
