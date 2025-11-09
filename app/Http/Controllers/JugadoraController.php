<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JugadoraController extends Controller
{

    public function index()
    {
        $jugadores = $this->getJugadoresFromSession();

        return view('jugadores.index', compact('jugadores'));
    }

    public function create()
    {
        $posicions = ['Portera', 'Defensa', 'Migcampista', 'Davantera'];

        return view('jugadores.create', compact('posicions'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'   => 'required|min:3',
            'equip' => 'required|min:2',
            'posicio' => 'required|in:Portera,Defensa,Migcampista,Davantera',
        ]);

        $jugadores = $this->getJugadoresFromSession();
        $jugadores[] = $validated;

        session(['jugadores' => $jugadores]);

        return redirect()
            ->route('jugadores.index')
            ->with('success', 'Jugadora creada correctament.');
    }

    protected function getJugadoresFromSession(): array
    {
        if (!session()->has('jugadores')) {
            $seed = [
                [
                    'nom'    => 'Alexia Putellas',
                    'equip'  => 'Barça Femení',
                    'posicio'=> 'Migcampista',
                ],
                [
                    'nom'    => 'Esther González',
                    'equip'  => 'Atlètic de Madrid',
                    'posicio'=> 'Davantera',
                ],
                [
                    'nom'    => 'Misa Rodríguez',
                    'equip'  => 'Real Madrid Femení',
                    'posicio'=> 'Portera',
                ],
            ];

            session(['jugadores' => $seed]);
        }

        return session('jugadores', []);
    }
}
