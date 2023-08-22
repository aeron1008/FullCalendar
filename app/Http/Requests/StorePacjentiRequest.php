<?php

namespace App\Http\Requests;

use App\Models\Pacjenti;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePacjentiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pacjenti_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
        ];
    }
}
