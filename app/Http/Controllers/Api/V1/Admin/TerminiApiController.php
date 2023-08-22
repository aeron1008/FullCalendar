<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTerminuRequest;
use App\Http\Requests\UpdateTerminuRequest;
use App\Http\Resources\Admin\TerminuResource;
use App\Models\Terminu;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TerminiApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('terminu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TerminuResource(Terminu::with(['pacjent', 'zaposlenik'])->get());
    }

    public function store(StoreTerminuRequest $request)
    {
        $terminu = Terminu::create($request->all());

        return (new TerminuResource($terminu))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Terminu $terminu)
    {
        abort_if(Gate::denies('terminu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TerminuResource($terminu->load(['pacjent', 'zaposlenik']));
    }

    public function update(UpdateTerminuRequest $request, Terminu $terminu)
    {
        $terminu->update($request->all());

        return (new TerminuResource($terminu))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Terminu $terminu)
    {
        abort_if(Gate::denies('terminu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $terminu->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}