<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePacjentiRequest;
use App\Http\Requests\UpdatePacjentiRequest;
use App\Http\Resources\Admin\PacjentiResource;
use App\Models\Pacjenti;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PacjentiApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pacjenti_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PacjentiResource(Pacjenti::all());
    }

    public function store(StorePacjentiRequest $request)
    {
        $pacjenti = Pacjenti::create($request->all());

        return (new PacjentiResource($pacjenti))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Pacjenti $pacjenti)
    {
        abort_if(Gate::denies('pacjenti_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PacjentiResource($pacjenti);
    }

    public function update(UpdatePacjentiRequest $request, Pacjenti $pacjenti)
    {
        $pacjenti->update($request->all());

        return (new PacjentiResource($pacjenti))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Pacjenti $pacjenti)
    {
        abort_if(Gate::denies('pacjenti_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pacjenti->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
