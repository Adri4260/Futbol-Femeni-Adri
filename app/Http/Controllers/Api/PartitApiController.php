<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partit;
use App\Http\Resources\PartitResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PartitApiController extends Controller
{
    public function index()
    {
        return PartitResource::collection(Partit::paginate(10));
    }

    public function show($id)
    {
        $partit = Partit::with(['local', 'visitant', 'estadi'])->find($id);
        if (!$partit) return response()->json(['error' => 'No trobat'], 404);
        return new PartitResource($partit);
    }

    public function store(Request $request)
    {
        if (!Gate::allows('create', Partit::class)) {
            return response()->json(['error' => 'No tens permisos per crear partits'], 403);
        }

        // Validació completa (Punt 3 de la rúbrica)
        $validated = $request->validate([
            'local_id'    => 'required|exists:equips,id',
            'visitant_id' => 'required|exists:equips,id|different:local_id',
            'estadi_id'   => 'required|exists:estadis,id',
            'data'        => 'required|date',
            'resultat'    => 'nullable|string|max:20',
        ]);

        $partit = Partit::create($validated);

        return response()->json([
            'message' => 'Partit creat correctament',
            'data' => new PartitResource($partit)
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $partit = Partit::find($id);
        if (!$partit) return response()->json(['error' => 'Partit no trobat'], 404);

        if (!Gate::allows('update', $partit)) {
            return response()->json(['error' => 'No tens permisos per editar aquest partit'], 403);
        }

        // Gestió de rols (Punt 4 de la rúbrica)
        if ($request->user()->role === 'arbitre') {
            // L'àrbitre només valida el resultat
            $validated = $request->validate([
                'resultat' => 'required|string|max:20', // Format "2-1"
            ]);
            $partit->update(['resultat' => $validated['resultat']]);
        } else {
            // L'Admin ho valida tot
            $validated = $request->validate([
                'local_id'    => 'exists:equips,id',
                'visitant_id' => 'exists:equips,id|different:local_id',
                'estadi_id'   => 'exists:estadis,id',
                'data'        => 'date',
                'resultat'    => 'nullable|string|max:20',
            ]);
            $partit->update($validated);
        }

        return new PartitResource($partit);
    }

    public function destroy($id)
    {
        $partit = Partit::find($id);
        if (!$partit) return response()->json(['error' => 'No trobat'], 404);

        if (!Gate::allows('delete', $partit)) {
            return response()->json(['error' => 'No autoritzat'], 403);
        }
        $partit->delete();
        return response()->json(['message' => 'Eliminat']);
    }
}
