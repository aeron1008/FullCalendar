<?php

namespace App\Http\Requests;

use App\Models\Terminu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTerminuRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('terminu_edit');
    }

    public function rules()
    {
        return [
            'pacjent_id' => [
                'required',
                'integer',
            ],
            'start_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'finish_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'selected_teeth' => 'nullable|array',
        ];
    }
}
