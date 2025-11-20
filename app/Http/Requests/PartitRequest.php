<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartitRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'local_id' => 'required|exists:equips,id',
            'visitant_id' => 'required|exists:equips,id|different:local_id',
            'estadi_id' => 'nullable|exists:estadis,id',
            'data' => 'required|date_format:Y-m-d',
            'jornada' => 'nullable|integer|min:1',
            'resultat' => ['nullable', 'regex:/^\d+-\d+$/'],
        ];
    }

    public function messages()
    {
        return [
            'resultat.regex' => 'El resultat ha de tenir format X-Y (ex.: 2-1).',
            'visitant_id.different' => 'L\'equip visitant ha de ser diferent del local.',
        ];
    }
}
