@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pacjenti.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pacjentis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pacjenti.fields.id') }}
                        </th>
                        <td>
                            {{ $pacjenti->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pacjenti.fields.name') }}
                        </th>
                        <td>
                            {{ $pacjenti->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pacjenti.fields.email') }}
                        </th>
                        <td>
                            {{ $pacjenti->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pacjenti.fields.phone') }}
                        </th>
                        <td>
                            {{ $pacjenti->phone }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pacjentis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection