@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            Kreiraj Pacjenta
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.pacjentis.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.pacjenti.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required placeholder="Marko Marković">
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="email">{{ trans('cruds.pacjenti.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="marko_markovic@gmail.com">
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="required">{{ trans('cruds.pacjenti.fields.phone') }}</label>
                        <select name="country_code" id="country_code" class="form-control select" required>
                            @foreach($country_codes as $code => $country)
                                <option value="{{ $code }}" {{ (isset($default_country_code) && $code == $default_country_code) ? 'selected' : '' }}> {{ $country['flag'] }} {{ $country['name'] }} (+{{ $code }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <label class="required" style="opacity: 0;">{{ trans('cruds.pacjenti.fields.phone') }} - placeholder</label>
                        <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required placeholder="998234428">
                        @if($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                    </div>
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

@section('scripts')
<script>
document.getElementById('phone').addEventListener('input', function(event) {
const phoneNumber = event.target.value;
if (phoneNumber.startsWith('0')) {
event.target.value = phoneNumber.slice(1);
}
});
</script>
@endsection
                
