<?php

namespace App\Http\Controllers;

use App\Services\EquipService;
use App\Http\Requests\StoreEquipRequest;
use App\Models\Equip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EquipController extends Controller
{
    protected $equipService;

    public function __construct(EquipService $equipService)
    {
        $this->equipService = $equipService;
    }

    public function index()
    {
        $equips = $this->equipService->all();
        return view('equips.index', compact('equips'));
    }

    public function show($id)
    {
        $equip = $this->equipService->find($id);
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

    public function store(StoreEquipRequest $request)
    {
        $this->equipService->create($request->validated());

        return redirect()->route('equips.index')->with('success', 'Equip creat correctament.');
    }

    public function edit(Equip $equip)
    {
        // Verifica si el usuario tiene permiso para 'update' este equipo
        Gate::authorize('update', $equip);

        return view('equips.edit', compact('equip'));
    }

    public function update(StoreEquipRequest $request, Equip $equip) // O UpdateEquipRequest si lo tienes
    {
        Gate::authorize('update', $equip);

        // ... tu lógica de actualización existente ...
        $this->equipService->update($equip->id, $request->validated());

        return redirect()->route('equips.index')->with('success', 'Equip actualitzat.');
    }

    public function destroy(Equip $equip)
    {
        Gate::authorize('delete', $equip);

        $this->equipService->delete($equip->id);

        return redirect()->route('equips.index')->with('success', 'Equip eliminat.');
    }
}
