<?php

namespace App\Http\Controllers;

use App\Models\Partit;
use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Http\Request;

class PartitController extends Controller
{
    public function index()
    {
        $partits = Partit::with(['local', 'visitant', 'estadi'])->get();
        return view('partits.index', compact('partits'));
    }

    public function create()
    {
        $equips = Equip::all();      // Agafem tots els equips
        $estadios = Estadi::all();   // Agafem tots els estadis

        return view('partits.create', compact('equips', 'estadios'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'local_id'    => 'required|exists:equips,id',
            'visitant_id' => 'required|exists:equips,id|different:local_id',
            'estadi_id'   => 'nullable|exists:estadis,id',
            'data'        => 'required|date_format:Y-m-d',
            'resultat'    => ['nullable', 'regex:/^\d+-\d+$/'],
        ], [
            'resultat.regex' => 'El resultat ha de ser del tipus "X-Y" (per ex. 2-1).',
        ]);

        Partit::create($validated);

        return redirect()
            ->route('partits.index')
            ->with('success', 'Partit creat correctament.');
    }
}
