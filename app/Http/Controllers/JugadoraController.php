<?php

namespace App\Http\Controllers;

use App\Models\Jugadora;
use App\Models\Equip;
use Illuminate\Http\Request;

class JugadoraController extends Controller
{
    public function index()
    {
        $jugadores = Jugadora::with('equip')->get();
        return view('jugadores.index', compact('jugadores'));
    }

    public function create()
    {
        $equips = Equip::all();
        return view('jugadores.create', compact('equips'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'posicio' => 'required|string|max:255',
            'equip_id' => 'nullable|exists:equips,id',
        ]);

        Jugadora::create($validated);

        return redirect()->route('jugadores.index')->with('success', 'Jugadora creada correctament.');
    }

    // --- MÉTODOS QUE TE FALTABAN ---

    public function edit(Jugadora $jugadora)
    {
        $equips = Equip::all();
        return view('jugadores.edit', compact('jugadora', 'equips'));
    }

    public function update(Request $request, Jugadora $jugadora)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'posicio' => 'required|string|max:255',
            'equip_id' => 'nullable|exists:equips,id',
        ]);

        $jugadora->update($validated);

        return redirect()->route('jugadores.index')->with('success', 'Jugadora actualitzada correctament.');
    }

    public function destroy(Jugadora $jugadora)
    {
        $jugadora->delete();
        return redirect()->route('jugadores.index')->with('success', 'Jugadora eliminada correctament.');
    }
}
