<?php

namespace App\Http\Controllers;

use App\Models\Jugadora;
use App\Models\Equip;
use Illuminate\Http\Request;

class JugadoraController extends Controller
{
    public function index()
    {
        // Agafa totes les jugadores amb l'equip relacionat
        $jugadores = Jugadora::with('equip')->get();

        return view('jugadores.index', compact('jugadores'));
    }

    public function create()
    {
        $posicions = ['Davanter', 'Defensa', 'Porter', 'Migcampista'];
        $equips = Equip::all(); // Si vols un select amb equips existents

        return view('jugadores.create', compact('posicions', 'equips'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'cognoms' => 'required|string|max:255', // afegit
            'equip_id' => 'required|exists:equips,id',
            'posicio' => 'required|string',
        ]);

        Jugadora::create($data);

        return redirect()->route('jugadores.index')->with('success', 'Jugadora creada!');
    }
}
