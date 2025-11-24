<?php

namespace App\Http\Controllers;

use App\Models\Equip;
use Illuminate\Http\Request;

class EquipController extends Controller
{
    public function index()
    {
        $equips = Equip::all(); // o paginate si vols
        return view('equips.index', compact('equips'));
    }

    public function show($id)
    {
        $equip = Equip::find($id); // trobar per ID

        if (!$equip) {
            return redirect()->route('equips.index')->with('error', 'Equip no trobat.');
        }

        return view('equips.show', compact('equip'));
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
