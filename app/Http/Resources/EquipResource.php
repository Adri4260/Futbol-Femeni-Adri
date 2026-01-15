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
            'nom_equip' => $this->nom,
            'ciutat' => $this->ciutat,
            'lliga' => $this->lliga,
            'escut_url' => $this->escut ? asset('storage/' . $this->escut) : null,
        ];
    }
}
