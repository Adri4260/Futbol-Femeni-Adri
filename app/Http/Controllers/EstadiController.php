<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstadiController extends Controller
{
    public function index()
    {
        $estadis = $this->getEstadisFromSession();

        return view('estadis.index', compact('estadis'));
    }

    public function create()
    {
        return view('estadis.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'             => 'required|min:3',
            'ciutat'          => 'required|min:2',
            'capacitat'       => 'required|integer|min:0',
            'equip_principal' => 'required|min:3',
        ]);

        $estadis = $this->getEstadisFromSession();
        $estadis[] = $validated;

        session(['estadis' => $estadis]);

        return redirect()
            ->route('estadis.index')
            ->with('success', 'Estadi creat correctament.');
    }

    protected function getEstadisFromSession(): array
    {
        if (!session()->has('estadis')) {
            $seed = [
                [
                    'nom'             => 'Estadi Johan Cruyff',
                    'ciutat'          => 'Sant Joan Despí',
                    'capacitat'       => 6000,
                    'equip_principal' => 'FC Barcelona Femení',
                ],
                [
                    'nom'             => 'Centro Deportivo Wanda Alcalá de Henares',
                    'ciutat'          => 'Alcalá de Henares',
                    'capacitat'       => 2800,
                    'equip_principal' => 'Atlètic de Madrid Femení',
                ],
                [
                    'nom'             => 'Estadio Alfredo Di Stéfano',
                    'ciutat'          => 'Madrid',
                    'capacitat'       => 6000,
                    'equip_principal' => 'Real Madrid Femení',
                ],
            ];

            session(['estadis' => $seed]);
        }

        return session('estadis', []);
    }
}
