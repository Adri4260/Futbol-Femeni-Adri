<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nom' => 'required|string|min:3',
            'ciutat' => 'required|string|min:2',
            'lliga' => 'nullable|string|min:3',
            'escut' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ];
    }
}
