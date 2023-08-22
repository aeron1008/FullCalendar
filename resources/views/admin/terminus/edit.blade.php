@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} Termin 
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.terminus.update", [$terminu->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="pacjent_id">{{ trans('cruds.terminu.fields.pacjent') }}</label>
                        <select class="form-control select2 {{ $errors->has('pacjent') ? 'is-invalid' : '' }}" name="pacjent_id" id="pacjent_id" required>
                            @foreach($pacjents as $id => $entry)
                                <option value="{{ $id }}" {{ (old('pacjent_id') ? old('pacjent_id') : $terminu->pacjent->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('pacjent'))
                            <span class="text-danger">{{ $errors->first('pacjent') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.terminu.fields.pacjent_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="zaposlenik_id">{{ trans('cruds.terminu.fields.zaposlenik') }}</label>
                        <select class="form-control select2 {{ $errors->has('zaposlenik') ? 'is-invalid' : '' }}" name="zaposlenik_id" id="zaposlenik_id">
                            @foreach($zaposleniks as $id => $entry)
                                <option value="{{ $id }}" {{ (old('zaposlenik_id') ? old('zaposlenik_id') : $terminu->zaposlenik->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('zaposlenik'))
                            <span class="text-danger">{{ $errors->first('zaposlenik') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.terminu.fields.zaposlenik_helper') }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="start_time">{{ trans('cruds.terminu.fields.start_time') }}</label>
                        <input class="form-control datetime {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time', $terminu->start_time) }}" required>
                        @if($errors->has('start_time'))
                            <span class="text-danger">{{ $errors->first('start_time') }}</span>
                        @endif
                <span class="help-block">{{ trans('cruds.terminu.fields.start_time_helper') }}</span>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="finish_time">{{ trans('cruds.terminu.fields.finish_time') }}</label>
                        <input class="form-control datetime {{ $errors->has('finish_time') ? 'is-invalid' : '' }}" type="text" name="finish_time" id="finish_time" value="{{ old('finish_time', $terminu->finish_time) }}" required>
                        @if($errors->has('finish_time'))
                            <span class="text-danger">{{ $errors->first('finish_time') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.terminu.fields.finish_time_helper') }}</span>
                    </div>
                </div>
                </div>
                <div class="form-group">
                    <label for="komentar">{{ trans('cruds.terminu.fields.komentar') }}</label>
                    <textarea class="form-control {{ $errors->has('komentar') ? 'is-invalid' : '' }}" name="komentar" id="komentar">{{ old('komentar', $terminu->komentar) }}</textarea>
                    @if($errors->has('komentar'))
                        <span class="text-danger">{{ $errors->first('komentar') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.terminu.fields.komentar_helper') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

