<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Equip;
use App\Http\Resources\EquipResource;
use Illuminate\Http\JsonResponse;

class EquipApiController extends Controller
{
    // Obtener todos los equipos
    public function index()
    {
        $equips = Equip::all();
        // Usamos collection porque son muchos
        return EquipResource::collection($equips);
    }

    // Obtener un equipo concreto
    public function show($id)
    {
        $equip = Equip::find($id);

        if (!$equip) {
            return response()->json(['message' => 'Equip no trobat'], 404);
        }

        // Usamos make o new porque es uno solo
        return new EquipResource($equip);
    }
}
