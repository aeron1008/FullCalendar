<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPacjentiRequest;
use App\Http\Requests\StorePacjentiRequest;
use App\Http\Requests\UpdatePacjentiRequest;
use App\Models\Pacjenti;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PacjentiController extends Controller
{
    public function index(Request $request)
{
    abort_if(Gate::denies('pacjenti_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    if ($request->ajax()) {
        $query = Pacjenti::where('user_id', auth()->id())->select(sprintf('%s.*', (new Pacjenti)->table));
        $table = Datatables::of($query);

        $table->addColumn('placeholder', '&nbsp;');
        $table->addColumn('actions', '&nbsp;');

        $table->editColumn('actions', function ($row) {
            $viewGate      = 'pacjenti_show';
            $editGate      = 'pacjenti_edit';
            $deleteGate    = 'pacjenti_delete';
            $crudRoutePart = 'pacjentis';

            return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
        });

        
        $table->editColumn('name', function ($row) {
            return $row->name ? $row->name : '';
        });
        $table->editColumn('email', function ($row) {
            return $row->email ? $row->email : '';
        });
        $table->editColumn('phone', function ($row) {
            return $row->country_code && $row->phone ? '(' . $row->country_code . ') ' . $row->phone : '';
        });



        $table->rawColumns(['actions', 'placeholder']);

        return $table->make(true);
    }

    return view('admin.pacjentis.index');
}


    public function create()
    {
        abort_if(Gate::denies('pacjenti_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $country_codes = require config('app.country_codes');
        $default_country_code = '+385';


        return view('admin.pacjentis.create', compact('country_codes', 'default_country_code'));

        
    }


    public function store(StorePacjentiRequest $request)
{
    // Create new Pacjenti instance with the provided data
    $pacjenti = new Pacjenti($request->all());

    // Set the country code and phone number
    $pacjenti->country_code = $request->input('country_code');
    $pacjenti->phone = $request->input('phone');

    // Set current user as the owner
    $pacjenti->user_id = auth()->id();

    // Save the Pacjenti instance
    $pacjenti->save();

    return redirect()->route('admin.pacjentis.index');
}



    public function edit(Pacjenti $pacjenti)
    {
        abort_if(Gate::denies('pacjenti_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $country_codes = require config('app.country_codes');
        $default_country_code = '385';

        $current_country_code = '';
        foreach ($country_codes as $code => $country) {
            if (substr($pacjenti->phone, 0, strlen($code)) == $code) {
                $current_country_code = $code;
                break;
            }
        }

        $phone_without_country_code = $pacjenti->phone;
    
        return view('admin.pacjentis.edit', compact('pacjenti', 'country_codes', 'default_country_code', 'phone_without_country_code'));
    }





    public function update(UpdatePacjentiRequest $request, Pacjenti $pacjenti)
    {
        $data = $request->all();
        $data['country_code'] = $request->input('country_code');
        $data['phone'] = $request->input('phone');
        $pacjenti->update($data);
    
        return redirect()->route('admin.pacjentis.index');
    }

    public function show(Pacjenti $pacjenti)
    {
        abort_if(Gate::denies('pacjenti_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            return view('admin.pacjentis.show', compact('pacjenti'));
}

public function destroy(Pacjenti $pacjenti)
{
    abort_if(Gate::denies('pacjenti_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $pacjenti->delete();

    return back();
}

public function massDestroy(MassDestroyPacjentiRequest $request)
{
    $pacjentis = Pacjenti::find(request('ids'));

    foreach ($pacjentis as $pacjenti) {
        $pacjenti->delete();
    }

    return response(null, Response::HTTP_NO_CONTENT);
}
}
