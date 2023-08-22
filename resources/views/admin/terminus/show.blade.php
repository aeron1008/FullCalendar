@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.terminu.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.terminus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.terminu.fields.id') }}
                        </th>
                        <td>
                            {{ $terminu->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.terminu.fields.pacjent') }}
                        </th>
                        <td>
                            {{ $terminu->pacjent->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.terminu.fields.zaposlenik') }}
                        </th>
                        <td>
                            {{ $terminu->zaposlenik->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.terminu.fields.start_time') }}
                        </th>
                        <td>
                            {{ $terminu->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.terminu.fields.finish_time') }}
                        </th>
                        <td>
                            {{ $terminu->finish_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.terminu.fields.komentar') }}
                        </th>
                        <td>
                            {{ $terminu->komentar }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.terminus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection