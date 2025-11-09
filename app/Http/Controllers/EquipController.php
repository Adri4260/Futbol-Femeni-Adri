<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EquipController extends Controller
{
    public function index()
    {
        $equips = $this->getEquips();

        return view('equips.index', compact('equips'));
    }

    public function create()
    {
        return view('equips.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'   => 'required|min:3',
            'ciutat'=> 'required|min:2',
            'lliga' => 'required|min:3',
        ]);

        $equips = $this->getEquips();
        $equips[] = $validated;

        session(['equips' => $equips]);

        return redirect()
            ->route('equips.index')
            ->with('success', 'Equip creat correctament.');
    }

    public function show(int $index)
    {
        $equips = $this->getEquips();

        abort_if(!isset($equips[$index]), 404);

        $equip = $equips[$index];

        return view('equips.show', compact('equip', 'index'));
    }

    protected function getEquips(): array
    {
        if (!session()->has('equips')) {
            $seed = [
                [
                    'nom'    => 'Barça Femení',
                    'ciutat' => 'Barcelona',
                    'lliga'  => 'Lliga F',
                ],
                [
                    'nom'    => 'Atlètic de Madrid Femení',
                    'ciutat' => 'Madrid',
                    'lliga'  => 'Lliga F',
                ],
                [
                    'nom'    => 'Real Madrid Femení',
                    'ciutat' => 'Madrid',
                    'lliga'  => 'Lliga F',
                ],
            ];

            session(['equips' => $seed]);
        }

        return session('equips', []);
    }
}
