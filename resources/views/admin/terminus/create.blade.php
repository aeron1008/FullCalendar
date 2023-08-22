@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.terminu.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.terminus.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required" for="pacjent_id">{{ trans('cruds.terminu.fields.pacjent') }}</label>
                            <span><a href="{{ route('admin.pacjentis.create') }}">Create New +</a></span>
                            <select class="form-control select2 {{ $errors->has('pacjent') ? 'is-invalid' : '' }}"
                                name="pacjent_id" id="pacjent_id" required disabled>
                                @foreach ($pacjents as $id => $entry)
                                    <option value="{{ $id }}" {{ old('pacjent_id') == $id ? 'selected' : '' }}>
                                        {{ $entry }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('pacjent'))
                                <span class="text-danger">{{ $errors->first('pacjent') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.terminu.fields.pacjent_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="zaposlenik_id">{{ trans('cruds.terminu.fields.zaposlenik') }}</label>
                            <select class="form-control select2 {{ $errors->has('zaposlenik') ? 'is-invalid' : '' }}"
                                name="zaposlenik_id" id="zaposlenik_id" disabled>
                                @foreach ($zaposleniks as $id => $entry)
                                    <option value="{{ $id }}"
                                        {{ old('zaposlenik_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('zaposlenik'))
                                <span class="text-danger">{{ $errors->first('zaposlenik') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.terminu.fields.zaposlenik_helper') }}</span>
                        </div>
                    </div>
                </div> <!-- Zatvorite div s row -->

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required" for="start_time">{{ trans('cruds.terminu.fields.start_time') }}</label>
                            <input class="form-control datetime {{ $errors->has('start_time') ? 'is-invalid' : '' }}"
                                type="text" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                            @if ($errors->has('start_time'))
                                <span class="text-danger">{{ $errors->first('start_time') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.terminu.fields.start_time_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required"
                                for="finish_time">{{ trans('cruds.terminu.fields.finish_time') }}</label>
                            <input class="form-control datetime {{ $errors->has('finish_time') ? 'is-invalid' : '' }}"
                                type="text" name="finish_time" id="finish_time" value="{{ old('finish_time') }}"
                                required>
                            @if ($errors->has('finish_time'))
                                <span class="text-danger">{{ $errors->first('finish_time') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.terminu.fields.finish_time_helper') }}</span>
                        </div>
                    </div>
                </div> <!-- Zatvorite div s row -->

                <div class="form-group">
                    <label for="komentar">{{ trans('cruds.terminu.fields.komentar') }}</label>
                    <textarea class="form-control {{ $errors->has('komentar') ? 'is-invalid' : '' }}" name="komentar" id="komentar">{{ old('komentar') }}</textarea>
                    @if ($errors->has('komentar'))
                        <span class="text-danger">{{ $errors->first('komentar') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.terminu.fields.komentar_helper') }}</span>
                </div>

                <!-- Dentalni karton style -->


                <style>
                    .dental-karton-container {
                        display: flex;
                        flex-direction: column;
                    }

                    .row {
                        display: flex;
                        justify-content: center;
                    }

                    .zub-container {
                        margin: 10px;
                    }

                    .zub-container input[type="checkbox"] {
                        display: block;
                        margin: 0 auto;
                        width: 20px;
                        height: 20px;
                        cursor: pointer;
                    }

                    .zub-container label {
                        display: block;
                        text-align: center;
                        font-size: 20px;
                        cursor: pointer;
                    }

                    /* Razmak između zubi 11 i 21 u prvom redu */
                    #zub_11+.zub-container {
                        margin-right: 60px;
                    }

                    /* Razmak između zubi 41 i 31 u drugom redu */
                    #zub_41+.zub-container {
                        margin-right: 60px;
                    }

                    .zub-container img {
                        display: block;
                        width: 45%;
                        height: auto;
                        margin: 10px auto;
                    }

                    .select2 {}
                </style>

                <!-- Dentalni karton -->
                <div class="form-group">
                    <label for="dental_karton">{{ trans('Dentalni karton') }}</label>
                    <div class="dental-karton-container">
                        <div class="row">
                            @php
                                $zubiPrviRed = [18, 17, 16, 15, 14, 13, 12, 11, 21, 22, 23, 24, 25, 26, 27, 28];
                                $zubiDrugiRed = [48, 47, 46, 45, 44, 43, 42, 41, 31, 32, 33, 34, 35, 36, 37, 38];
                            @endphp
                            @foreach ($zubiPrviRed as $zub)
                                <div class="zub-container">
                                    <input type="checkbox" name="selected_teeth[]" value="{{ $zub }}"
                                        id="zub_{{ $zub }}">
                                    <label for="zub_{{ $zub }}">{{ $zub }}</label>
                                    <img src="{{ asset('images/zubi/zub_' . $zub . '.png') }}"
                                        alt="Zub {{ $zub }}">
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            @foreach ($zubiDrugiRed as $zub)
                                <div class="zub-container">
                                    <input type="checkbox" name="selected_teeth[]" value="{{ $zub }}"
                                        id="zub_{{ $zub }}">
                                    <label for="zub_{{ $zub }}">{{ $zub }}</label>
                                    <img src="{{ asset('images/zubi/zub_' . $zub . '.png') }}"
                                        alt="Zub {{ $zub }}">
                                </div>
                            @endforeach

                        </div>
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
    <input type="hidden" name="selected_teeth" id="selected_teeth" value="{{ old('selected_teeth') }}">
@endsection

@section('scripts')
    <script>
        $(window).on('load', function() {
            $(".select2").attr('disabled', false);
        });

        $("#start_time").on("dp.change", function(e) {
            $('#finish_time').data("DateTimePicker").date(currDate(e.date._d))
        });

        function currDate(date2) {
            var d = date2;
            var y = d.getFullYear();
            var m = d.getMonth();
            var da = d.getDate();
            var h = d.getHours();
            var mi = d.getMinutes() + 30;
            var se = d.getSeconds();
            var mDate = new Date(y, m, da, h, mi, se);
            return mDate;

        };
    </script>
@endsection
