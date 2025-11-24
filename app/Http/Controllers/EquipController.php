<?php

namespace App\Http\Controllers;

use App\Models\Equip;
use Illuminate\Http\Request;

class EquipController extends Controller
{
    public function index()
    {
        $equips = Equip::all();
        return view('equips.index', compact('equips'));
    }

    public function show($id)
    {
        $equip = Equip::findOrFail($id);

        $partitsJugats = $equip->partitsLocal->whereNotNull('resultat')
            ->merge($equip->partitsVisitant->whereNotNull('resultat'));

        $partitsPendents = $equip->partitsLocal->whereNull('resultat')
            ->merge($equip->partitsVisitant->whereNull('resultat'));

        return view('equips.show', compact('equip', 'partitsJugats', 'partitsPendents'));
    }

    public function create()
    {
        return view('equips.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'ciutat' => 'nullable|string|max:255',
            'lliga' => 'nullable|string|max:255',
        ]);

        Equip::create($request->only('nom', 'ciutat', 'lliga'));

        return redirect()->route('equips.index')->with('success', 'Equip creat correctament.');
    }
}
