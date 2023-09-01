<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pacjenti;
use App\Models\Zaposlenici;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\Terminu',
            'date_field' => 'start_time',
            'field'      => 'komentar',
            'prefix'     => '',
            'suffix'     => '',
            'route'      => 'admin.terminus.edit',
        ],
    ];

    public function index()
    {
        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (! $crudFieldValue) {
                    continue;
                }

                $selectedTeeth = implode(',', json_decode($model->selected_teeth) ?? []);

                $title = "{$model->pacjent->name}";
                // $title .= "{$model->komentar} \n";
                // $title .= "{$selectedTeeth} \n";

                $endTime = Carbon::createFromFormat('d.m.Y H:i', $model->finish_time);
                $doctor = $model->zaposlenik_id;                

                // $model->pacjent->name
                $events[] = [
                    'title' => $title,
                    'start' => $crudFieldValue,                     
                    'end'   => $endTime, 
                    'url'   => route($source['route'], $model->id),
                    'doctor' => $doctor,
                ];
            }
        }

        // create panel
        $user = Auth::user();
    
        $pacjents = Pacjenti::where('user_id', $user->id)
        ->pluck('name', 'id')
        ->prepend('Odaberi pacijenta', '');
    
        $zaposleniks = Zaposlenici::where('user_id', $user->id)
        ->pluck('name', 'id')
        ->prepend('Izaberi uslugu...', '');

        $doctors = Zaposlenici::where('user_id', $user->id)
        ->pluck('name', 'id');
        // ->prepend('Izaberi uslugu...', '');
        // dd($doctors);
    
        return view('admin.calendar.calendar', compact('events', 'pacjents', 'zaposleniks', 'doctors'));
    }
}