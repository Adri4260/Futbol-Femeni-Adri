<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estadi;
use App\Http\Resources\EstadiResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EstadiApiController extends Controller
{
    public function index()
    {
        return EstadiResource::collection(Estadi::paginate(10));
    }

    public function show($id)
    {
        $estadi = Estadi::find($id);
        if (!$estadi) return response()->json(['error' => 'No trobat'], 404);
        return new EstadiResource($estadi);
    }

    public function store(Request $request)
    {
        if (!Gate::allows('create', Estadi::class)) {
            return response()->json(['error' => 'No autoritzat'], 403);
        }
        $estadi = Estadi::create($request->validate([
            'nom' => 'required',
            'ciutat' => 'required',
            'capacitat' => 'required'
        ]));
        return new EstadiResource($estadi);
    }

    public function update(Request $request, $id)
    {
        $estadi = Estadi::find($id);
        if (!$estadi) return response()->json(['error' => 'No trobat'], 404);

        if (!Gate::allows('update', $estadi)) {
            return response()->json(['error' => 'No autoritzat'], 403);
        }
        $estadi->update($request->all());
        return new EstadiResource($estadi);
    }

    public function destroy($id)
    {
        $estadi = Estadi::find($id);
        if (!$estadi) return response()->json(['error' => 'No trobat'], 404);

        if (!Gate::allows('delete', $estadi)) {
            return response()->json(['error' => 'No autoritzat'], 403);
        }
        $estadi->delete();
        return response()->json(['message' => 'Eliminat']);
    }
}
