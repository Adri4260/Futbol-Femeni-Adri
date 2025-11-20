<?php

namespace App\Http\Controllers;

use App\Services\EquipService;
use Illuminate\Http\Request;

class EquipController extends Controller
{
    protected $service;

    public function __construct(EquipService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $equips = $this->service->all();
        return view('equips.index', compact('equips'));
    }

    public function show($id)
    {
        $equip = $this->service->find($id);
        return view('equips.show', compact('equip'));
    }

    public function create()
    {
        return view('equips.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'categoria' => 'nullable|string|max:255',
        ]);

        $this->service->create($validated);

        return redirect()->route('equips.index');
    }

    public function edit($id)
    {
        $equip = $this->service->find($id);
        return view('equips.edit', compact('equip'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'categoria' => 'nullable|string|max:255',
        ]);

        $this->service->update($id, $validated);

        return redirect()->route('equips.index');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('equips.index');
    }
}
