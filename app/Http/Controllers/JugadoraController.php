<?php

namespace App\Http\Controllers;

use App\Models\Jugadora;
use App\Models\Equip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importante para saber quién está logueado

class JugadoraController extends Controller
{
    public function index()
    {
        $jugadores = Jugadora::with('equip')->get();
        return view('jugadores.index', compact('jugadores'));
    }

    public function create()
    {
        $user = Auth::user();

        // Si es Manager, solo mostramos su equipo. Si es Admin, todos.
        if ($user->role === 'manager' && $user->team_id) {
            $equips = Equip::where('id', $user->team_id)->get();
        } else {
            $equips = Equip::all();
        }

        // Definimos las posiciones para el desplegable
        $posicions = ['Portera', 'Defensa', 'Migcampista', 'Davantera'];

        return view('jugadores.create', compact('equips', 'posicions'));
    }

    public function store(Request $request)
    {
        // Si tienes JugadoraRequest úsalo aquí: public function store(JugadoraRequest $request)
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'posicio' => 'required|string|in:Portera,Defensa,Migcampista,Davantera',
            'equip_id' => 'required|exists:equips,id',
        ]);

        Jugadora::create($validated);

        return redirect()->route('jugadores.index')->with('success', 'Jugadora creada correctament.');
    }

    public function edit(Jugadora $jugadora)
    {
        $user = Auth::user();

        // Control de seguridad extra: Manager solo edita sus jugadoras
        if ($user->role === 'manager' && $user->team_id !== $jugadora->equip_id) {
            abort(403, 'No pots editar jugadores d\'altres equips.');
        }

        if ($user->role === 'manager' && $user->team_id) {
            $equips = Equip::where('id', $user->team_id)->get();
        } else {
            $equips = Equip::all();
        }

        $posicions = ['Portera', 'Defensa', 'Migcampista', 'Davantera'];

        return view('jugadores.edit', compact('jugadora', 'equips', 'posicions'));
    }

    public function update(Request $request, Jugadora $jugadora)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'posicio' => 'required|string|max:255',
            'equip_id' => 'required|exists:equips,id',
        ]);

        $jugadora->update($validated);

        return redirect()->route('jugadores.index')->with('success', 'Jugadora actualitzada correctament.');
    }

    public function destroy(Jugadora $jugadora)
    {
        // La Policy ya protege esto, pero no está de más
        $jugadora->delete();
        return redirect()->route('jugadores.index')->with('success', 'Jugadora eliminada correctament.');
    }
}
