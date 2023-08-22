@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        @if(isset($status) && $status == 'success')
                            <div class="alert alert-success">
                                {{$message}}
                            </div>
                        @endif
                        @if(isset($status) && $status == 'error')
                            <div class="alert alert-error">
                                {{$message}}
                            </div>
                                <a href="{{route('admin.plans')}}"> Povratak na planove pretplate</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
