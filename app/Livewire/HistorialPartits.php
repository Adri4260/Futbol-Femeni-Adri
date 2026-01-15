<?php

namespace App\Livewire;

use App\Models\Partit;
use Livewire\Component;

class HistorialPartits extends Component
{
    public $equip = '';
    public $data = '';

    public $partits = [];

    public function mount()
    {
        $this->filtrar();
    }

    public function filtrar()
    {
        $this->partits = Partit::with(['local', 'visitant'])
            ->when($this->equip, function ($query) {
                $query->whereHas('local', fn($q) => $q->where('nom', 'like', "%{$this->equip}%"))
                    ->orWhereHas('visitant', fn($q) => $q->where('nom', 'like', "%{$this->equip}%"));
            })
            ->when($this->data, function ($query) {
                $query->whereDate('data', $this->data);
            })
            ->orderBy('data', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.historial-partits');
    }
}
