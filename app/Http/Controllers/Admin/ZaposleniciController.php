<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyZaposleniciRequest;
use App\Http\Requests\StoreZaposleniciRequest;
use App\Http\Requests\UpdateZaposleniciRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Zaposlenici;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ZaposleniciController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('zaposlenici_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

          if ($request->ajax()) {
            $query = Zaposlenici::where('user_id', auth()->id())->select(sprintf('%s.*', (new Zaposlenici)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'zaposlenici_show';
                $editGate      = 'zaposlenici_edit';
                $deleteGate    = 'zaposlenici_delete';
                $crudRoutePart = 'zaposlenicis';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.zaposlenicis.index');
    }

    public function create()
    {
        abort_if(Gate::denies('zaposlenici_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.zaposlenicis.create');
    }

    public function store(StoreZaposleniciRequest $request)
    {
    $user = Auth::user();

    // Create new Zaposlenici instance
    $zaposlenici = new Zaposlenici($request->all());

    // Set current user as the owner
    $zaposlenici->user_id = $user->id;

    // Save the Zaposlenici instance
    $zaposlenici->save();

    return redirect()->route('admin.zaposlenicis.index');
    }


    public function edit(Zaposlenici $zaposlenici)
    {
        abort_if(Gate::denies('zaposlenici_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.zaposlenicis.edit', compact('zaposlenici'));
    }

    public function update(UpdateZaposleniciRequest $request, Zaposlenici $zaposlenici)
    {
        $zaposlenici->update($request->all());

        return redirect()->route('admin.zaposlenicis.index');
    }

    public function show(Zaposlenici $zaposlenici)
    {
        abort_if(Gate::denies('zaposlenici_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.zaposlenicis.show', compact('zaposlenici'));
    }

    public function destroy(Zaposlenici $zaposlenici)
    {
        abort_if(Gate::denies('zaposlenici_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zaposlenici->delete();

        return back();
    }

    public function massDestroy(MassDestroyZaposleniciRequest $request)
    {
        $zaposlenicis = Zaposlenici::find(request('ids'));

        foreach ($zaposlenicis as $zaposlenici) {
            $zaposlenici->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
