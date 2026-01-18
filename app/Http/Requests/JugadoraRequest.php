<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class JugadoraRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Permitir solo si es admin o si es manager de ESE equipo
        if (Auth::user()->role === 'admin') return true;

        // Si es manager, verificamos que el equipo que intenta asignar sea el suyo
        if (Auth::user()->role === 'manager') {
            return $this->input('equip_id') == Auth::user()->team_id;
        }

        return false;
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'posicio' => 'required|string|in:Portera,Defensa,Migcampista,Davantera', // Ejemplo de validación
            'equip_id' => 'required|exists:equips,id',
            // La rúbrica pide validar años, dorsal, etc. Añádelos si tienes esos campos en la BD
            // 'dorsal' => 'required|integer|min:1|max:99', 
        ];
    }
}
