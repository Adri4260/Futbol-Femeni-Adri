<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartitController extends Controller
{

    public function index()
    {
        $partits = $this->getPartitsFromSession();

        return view('partits.index', compact('partits'));
    }

    public function create()
    {
        return view('partits.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'local'    => 'required|min:2',
                'visitant' => 'required|min:2|different:local',
                'data'     => 'required|date_format:Y-m-d',
                'resultat' => ['nullable', 'regex:/^\d+-\d+$/'],
            ],
            [
                'resultat.regex' => 'El resultat ha de ser del tipus "X-Y" (per ex. 2-1).',
            ]
        );

        $partits = $this->getPartitsFromSession();
        $partits[] = $validated;

        session(['partits' => $partits]);

        return redirect()
            ->route('partits.index')
            ->with('success', 'Partit creat correctament.');
    }

    protected function getPartitsFromSession(): array
    {
        if (!session()->has('partits')) {
            $seed = [
                [
                    'local'    => 'Barça Femení',
                    'visitant' => 'Atlètic de Madrid',
                    'data'     => '2024-11-30',
                    'resultat' => null,
                ],
                [
                    'local'    => 'Real Madrid Femení',
                    'visitant' => 'Barça Femení',
                    'data'     => '2024-12-15',
                    'resultat' => '0-3',
                ],
            ];

            session(['partits' => $seed]);
        }

        return session('partits', []);
    }
}
