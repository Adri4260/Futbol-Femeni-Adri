<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Equip;
use App\Http\Resources\EquipResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EquipApiController extends Controller
{
    public function index()
    {
        return EquipResource::collection(Equip::paginate(10));
    }

    public function show($id)
    {
        $equip = Equip::find($id);
        if (!$equip) return response()->json(['error' => 'No trobat'], 404);
        return new EquipResource($equip);
    }

    public function store(Request $request)
    {
        // Autorització (Admin o Manager)
        if (!Gate::allows('create', Equip::class)) {
            return response()->json(['error' => 'No autoritzat'], 403);
        }

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'ciutat' => 'required|string',
            'lliga' => 'required|string',
        ]);

        $equip = Equip::create($validated);
        return new EquipResource($equip);
    }

    public function update(Request $request, $id)
    {
        $equip = Equip::find($id);
        if (!$equip) return response()->json(['error' => 'No trobat'], 404);

        if (!Gate::allows('update', $equip)) {
            return response()->json(['error' => 'No autoritzat'], 403);
        }

        $equip->update($request->all());
        return new EquipResource($equip);
    }

    public function destroy($id)
    {
        $equip = Equip::find($id);
        if (!$equip) return response()->json(['error' => 'No trobat'], 404);

        if (!Gate::allows('delete', $equip)) {
            return response()->json(['error' => 'No autoritzat'], 403);
        }

        $equip->delete();
        return response()->json(['message' => 'Eliminat']);
    }
}
