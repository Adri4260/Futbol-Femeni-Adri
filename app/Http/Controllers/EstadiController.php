<?php

namespace App\Http\Controllers;

use App\Models\Estadi;
use App\Models\Equip;
use App\Http\Requests\EstadiRequest;

class EstadiController extends Controller
{
    public function index()
    {
        $estadis = Estadi::with('equipPrincipal')->paginate(12);
        return view('estadis.index', compact('estadis'));
    }

    public function create()
    {
        $equips = Equip::all();
        return view('estadis.create', compact('equips'));
    }

    public function store(EstadiRequest $request)
    {
        Estadi::create($request->validated());
        return redirect()->route('estadis.index')->with('success', 'Estadi creat.');
    }

    public function show(Estadi $estadi)
    {
        $estadi->load('equipPrincipal');
        return view('estadis.show', compact('estadi'));
    }

    public function edit(Estadi $estadi)
    {
        $equips = Equip::all();
        return view('estadis.edit', compact('estadi', 'equips'));
    }

    public function update(EstadiRequest $request, Estadi $estadi)
    {
        $estadi->update($request->validated());
        return redirect()->route('estadis.index')->with('success', 'Estadi actualitzat.');
    }

    public function destroy(Estadi $estadi)
    {
        $estadi->delete();
        return redirect()->route('estadis.index')->with('success', 'Estadi eliminat.');
    }
}
