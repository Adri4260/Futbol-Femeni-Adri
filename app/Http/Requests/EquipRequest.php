<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'ciutat' => 'required|string|max:255',
            'lliga' => 'required|string|max:255',
        ];
    }
}
