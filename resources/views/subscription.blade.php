@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Bit će vam naplaćeno  {{ number_format($plan->price, 2) }} € za {{ $plan->name }} 
                    </div>

                    <div class="card-body">

                        <form id="payment-form" action="{{ route('admin.subscription.create') }}" method="POST">
                            @csrf
                            <input type="hidden" name="plan" id="plan" value="{{ $plan->id }}">
                            <input type="hidden" name="plan_slug" id="plan_slug" value="{{ $plan->slug }}">

                            <div class="row">
                                <div class="col-xl-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" id="card-holder-name" class="form-control" value="" placeholder="Name on the card">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Podaci o kartici</label>
                                        <div id="card-element"></div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12">
                                    <div style="display: none; color:black !important; background-color:#f8d7da !important; padding: 5px" class="alert alert-danger" role="alert" id="payment-form-error">
                                        Ovo je upozorenje na opasnost - provjerite!
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">Purchase</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@parent

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ config('cashier.key') }}')

    const elements = stripe.elements()
    const cardElement = elements.create('card')
    cardElement.mount('#card-element')

    const form = document.getElementById('payment-form')
    const errorEle = document.getElementById('payment-form-error')
    const cardBtn = document.getElementById('card-button')
    const cardHolderName = document.getElementById('card-holder-name')

    form.addEventListener('submit', async (e) => {
        e.preventDefault()

        errorEle.innerText = '';
        errorEle.style = 'display:none';

        cardBtn.disabled = true
        const { setupIntent, error } = await stripe.confirmCardSetup(
            cardBtn.dataset.secret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            }
        )

        if(error) {
            errorEle.innerText = error?.message;
            errorEle.style = `display: block; color:black !important; background-color:#f8d7da !important; padding: 5px`;
            cardBtn.disabled = false
        } else {
            let token = document.createElement('input')
            token.setAttribute('type', 'hidden')
            token.setAttribute('name', 'token')
            token.setAttribute('value', setupIntent.payment_method)
            form.appendChild(token)
            form.submit();
        }
    })
</script>
@endsection
