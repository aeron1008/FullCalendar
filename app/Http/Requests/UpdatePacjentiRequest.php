<?php

namespace App\Http\Requests;

use App\Models\Pacjenti;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePacjentiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pacjenti_edit');
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
