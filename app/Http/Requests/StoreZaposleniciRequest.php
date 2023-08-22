<?php

namespace App\Http\Requests;

use App\Models\Zaposlenici;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreZaposleniciRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('zaposlenici_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
