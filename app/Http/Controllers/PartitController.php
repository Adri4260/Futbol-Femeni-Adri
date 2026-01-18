<?php

namespace App\Http\Controllers;

use App\Models\Partit;
use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth; // <--- IMPORTACIÓ AFEGIDA
use Barryvdh\DomPDF\Facade\Pdf;

class PartitController extends Controller
{
    public function index()
    {
        $partits = Partit::with(['local', 'visitant', 'estadi'])->orderBy('data', 'asc')->get();
        return view('partits.index', compact('partits'));
    }

    public function historic()
    {
        return view('partits.historic');
    }

    public function create()
    {
        Gate::authorize('create', Partit::class);
        return view('partits.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Partit::class);

        $validated = $request->validate([
            'local_id' => 'required|exists:equips,id',
            'visitant_id' => 'required|exists:equips,id|different:local_id',
            'estadi_id' => 'required|exists:estadis,id',
            'data' => 'required|date',
        ]);

        Partit::create($validated);

        return redirect()->route('partits.index')->with('success', 'Partit creat correctament.');
    }

    public function edit(Partit $partit)
    {
        Gate::authorize('update', $partit);

        $equips = Equip::all();
        $estadis = Estadi::all();

        return view('partits.edit', compact('partit', 'equips', 'estadis'));
    }

    public function update(Request $request, Partit $partit)
    {
        Gate::authorize('update', $partit);

        // CORRECCIÓ ACÍ: Usem Auth::user() en lloc de auth()->user()
        $user = Auth::user();

        // LÒGICA DIFERENCIADA SEGONS ROL
        if ($user->role === 'arbitre') {
            // L'àrbitre només pot tocar el resultat
            $validated = $request->validate([
                'resultat' => 'required|string|max:20',
            ]);

            $partit->update(['resultat' => $validated['resultat']]);
        } else {
            // L'Admin pot tocar-ho tot
            $validated = $request->validate([
                'local_id' => 'required|exists:equips,id',
                'visitant_id' => 'required|exists:equips,id|different:local_id',
                'estadi_id' => 'required|exists:estadis,id',
                'data' => 'required|date',
                'resultat' => 'nullable|string|max:20',
            ]);

            $partit->update($validated);
        }

        return redirect()->route('partits.index')->with('success', 'Partit actualitzat correctament.');
    }

    public function destroy(Partit $partit)
    {
        Gate::authorize('delete', $partit);

        $partit->delete();
        return redirect()->route('partits.index')->with('success', 'Partit eliminat.');
    }

    public function acta(Partit $partit)
    {
        $pdf = Pdf::loadView('partits.acta', compact('partit'));
        return $pdf->download('acta-partit-' . $partit->id . '.pdf');
    }
}
