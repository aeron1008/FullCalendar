<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreZaposleniciRequest;
use App\Http\Requests\UpdateZaposleniciRequest;
use App\Http\Resources\Admin\ZaposleniciResource;
use App\Models\Zaposlenici;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ZaposleniciApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('zaposlenici_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ZaposleniciResource(Zaposlenici::all());
    }

    public function store(StoreZaposleniciRequest $request)
    {
        $zaposlenici = Zaposlenici::create($request->all());

        return (new ZaposleniciResource($zaposlenici))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Zaposlenici $zaposlenici)
    {
        abort_if(Gate::denies('zaposlenici_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ZaposleniciResource($zaposlenici);
    }

    public function update(UpdateZaposleniciRequest $request, Zaposlenici $zaposlenici)
    {
        $zaposlenici->update($request->all());

        return (new ZaposleniciResource($zaposlenici))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Zaposlenici $zaposlenici)
    {
        abort_if(Gate::denies('zaposlenici_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zaposlenici->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
