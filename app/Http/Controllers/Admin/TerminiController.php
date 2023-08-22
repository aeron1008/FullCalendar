<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTerminuRequest;
use App\Http\Requests\StoreTerminuRequest;
use App\Http\Requests\UpdateTerminuRequest;
use App\Jobs\SendEmailReminder; 
use App\Jobs\SendWhatsAppReminder;
use App\Models\Pacjenti;
use App\Models\Terminu;
use App\Models\Zaposlenici;
use Gate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;

class TerminiController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('terminu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Terminu::with(['pacjent', 'zaposlenik'])->select(sprintf('%s.*', (new Terminu)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'terminu_show';
                $editGate      = 'terminu_edit';
                $deleteGate    = 'terminu_delete';
                $crudRoutePart = 'terminus';

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
            $table->addColumn('pacjent_name', function ($row) {
                return $row->pacjent ? $row->pacjent->name : '';
            });

            $table->addColumn('zaposlenik_name', function ($row) {
                return $row->zaposlenik ? $row->zaposlenik->name : '';
            });

            $table->editColumn('komentar', function ($row) {
                return $row->komentar ? $row->komentar : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'pacjent', 'zaposlenik']);

            return $table->make(true);
            
        }

        return view('admin.terminus.index');
        
    }

    public function create()
    {
        abort_if(Gate::denies('terminu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
        $user = Auth::user();
    
        $pacjents = Pacjenti::where('user_id', $user->id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
    
        $zaposleniks = Zaposlenici::where('user_id', $user->id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
    
        return view('admin.terminus.create', compact('pacjents', 'zaposleniks'));
        
    }
      
       public function store(StoreTerminuRequest $request)
{
    //Default Time Zone
    date_default_timezone_set("Europe/Ljubljana");
    $user = Auth::user();

    // Create new Terminu instance
    $terminu = new Terminu($request->all());

    // Set current user as the owner
    $terminu->user_id = $user->id;
        
    // Save the selected teeth data
    $terminu->selected_teeth = json_encode($request->input('selected_teeth', []));
    
    // Save the Terminu instance
    $terminu->save();

    // Load zaposlenik and pacjent relationships
    $terminu->load('zaposlenik', 'pacjent');

    $to = Carbon::parse($terminu->start_time);
    $from = Carbon::parse($terminu->finish_time);

    $diff_in_hours = $to->diffInHours($from);
    

    //if ($request->allow_notifications == true) {
        $pacjenti = Pacjenti::find($request->pacjent_id);
        $phone = "";
        $email = "";

        if ($pacjenti) {
            $phone = $pacjenti->country_code . $pacjenti->phone;
            $email = $pacjenti->email;
        }

        // Dispatch the email reminder job
        if (!empty($email)) {
            $d = SendEmailReminder::dispatch($email, $terminu);
        }
        \Log::info('Dispatching WhatsApp reminder job...');
        // Dispatch the WhatsApp reminder job
        if (!empty($phone)) {
            $dd =  SendWhatsAppReminder::dispatch($terminu->pacjent->country_code.$terminu->pacjent->phone, $terminu , Auth::user()->clinic_name , Auth::user()->clinic_address);
        }
        \Log::info('WhatsApp reminder job dispatched.');
    //}
    return redirect()->route('admin.systemCalendar');
    // return redirect()->route('admin.terminus.index');

}

       public function edit(Terminu $terminu)
    {
        abort_if(Gate::denies('terminu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pacjents = Pacjenti::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $zaposleniks = Zaposlenici::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $selected_teeth = json_decode($terminu->selected_teeth);

        $terminu->load('pacjent', 'zaposlenik');

        return view('admin.terminus.edit', compact('pacjents', 'terminu', 'zaposleniks', 'selected_teeth'));
    }

        public function update(UpdateTerminuRequest $request, Terminu $terminu)
    {
        $terminu->update($request->all());

        $terminu->selected_teeth = json_encode($request->input('selected_teeth', []));
        $terminu->save();

        return redirect()->route('admin.terminus.index');
    }

    public function show(Terminu $terminu)
    {
        abort_if(Gate::denies('terminu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $terminu->load('pacjent', 'zaposlenik');

        return view('admin.terminus.show', compact('terminu'));
    }

    public function destroy(Terminu $terminu)
    {
        abort_if(Gate::denies('terminu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $terminu->delete();

        return back();
    }

    public function massDestroy(MassDestroyTerminuRequest $request)
    {
        $terminus = Terminu::find(request('ids'));

        foreach ($terminus as $terminu) {
            $terminu->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
    
    public function cancelAppointment($id)
    {
        Terminu::where('id',$id)->delete();
        return view('cancel');
    }
}