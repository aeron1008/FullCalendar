@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Aktivni planovi</div>

                    <div class="card-body">

                        <div class="row">

                            @if(isset($sub_plan))
                                <div class="card col-sm-12">
                                    <div class="card-header"> Trenutačni aktivni plan <b><i>{{ strtoupper($sub_plan->name ) }}</i></b></div>
                                    <div class="card-body">
                                        @if($onTrial)
                                            <p>Probno razdoblje : <b>{{$sub_plan->created_at->format('dS M Y') }}</b> To
                                                <b>{{ $sub_plan->trial_ends_at->format('dS M Y') }}</b></p>
{{--                                        @else()--}}
{{--                                            <p>Obnova pretplate na plan : <b>{{ $sub_plan->ends_at ? $sub_plan->ends_at->format('dS M Y') : '' }}</b></p>--}}
                                        @endif

                                        @if(isset($userOnGracePeriod) && !$userOnGracePeriod )
                                            <form method="POST" action="{{ route('admin.subscription.cancel')}}">
                                                @csrf
                                                <input type="text" hidden name="cancel_plan"
                                                       value="{{$sub_plan->stripe_price}}">
                                                <input type="submit" value="Otkaži pretplatu"
                                                       onclick="return confirm('Jeste li sigurni da želite otkazati svoju pretplatu?')"
                                                       class="btn btn-danger pull-right"/>
                                            </form>
                                        @elseif($userOnGracePeriod)
                                                <p><b>Plan je predviđen da istekne na kraju pretplate.</b></p>
                                        @endif

                                    </div>
                                </div>

                            @endif


                            @if(isset($plans))
                                @foreach($plans as $plan)
                                    <div class="card">
                                        <div class="card-header"><h5> {{ $plan->name }} ({{  $plan->price }}€ Mjesečno)</h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text"> Trenutačno nemate aktivnu pretplatu, molimo vas da se pretplatite kako bi nastavili koristiti aplikaciju</p>

                                            <p>Besplatni probni period traje {{ App\Models\Plan::BASIC_PLAN_TRIAL}} dana i možete otkazati bilo kada </p>

                                            <form method="POST" action="{{ route('admin.subscription.create')}}">
                                                @csrf
                                                <input  type="submit" value="Pretplati me" class="btn btn-primary pull-right"/>
                                            </form>

{{--                                            <a href="{{ route('admin.plans.show', $plan->slug) }}"--}}
{{--                                               class="btn btn-primary pull-right">Pretplati me</a>--}}

                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@parent
@endsection

