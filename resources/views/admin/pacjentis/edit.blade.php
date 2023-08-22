@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} Pacjenta
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.pacjentis.update", [$pacjenti->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.pacjenti.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $pacjenti->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pacjenti.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.pacjenti.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $pacjenti->email) }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pacjenti.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.pacjenti.fields.phone') }}</label>
                <div class="form-row">
                    <div class="col-md-4">
                        <select name="country_code" id="country_code" class="form-control select" required>
                            <option value="" disabled {{ !isset($default_country_code) ? 'selected' : '' }}>{{ trans('global.select_country_code') }}</option>
                            @foreach($country_codes as $code => $country)
                                <option value="{{ $code }}" {{ (isset($default_country_code) && $code == $default_country_code) ? 'selected' : '' }}> {{ $country['flag'] }} {{ $country['name'] }} (+{{ $code }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8">
                        <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $pacjenti->phone) }}" required>
                    </div>
                </div>
                @if($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pacjenti.fields.phone_helper') }}</span>
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
