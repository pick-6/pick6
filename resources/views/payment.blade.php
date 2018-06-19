@extends('layouts.master')
@section('content')

<style>
    .StripeElement {
        background-color: white;
        height: 40px;
        padding: 10px 12px;
        border-radius: 4px;
        border: 1px solid transparent;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>

<h1 class="text-center" style="color: white;margin-bottom:40px;">Add More Credit</h1>


<div class="col-sm-4 text-center fc-grey">
    <div class="dashboardSection" style="height:300px;margin-bottom:20px;">
        <h3 class="fc-white" style="margin:0;">$5</h3>
    </div>
    <form action="{{action('PaymentController@charge')}}" method="POST">
        {{ csrf_field() }}
        <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="pk_test_7AL8K2hvvfLEyVuLe6eLL1jE"
        data-amount="500"
        data-description="Add $5 of Credit"
        data-locale="auto"
        data-label="Select"
        data-email="{{Auth::user()->email}}"
        data-zip-code="true">
        </script>
        <input type="hidden" name="amount" value="500"/>
        <input type="hidden" name="description" value="$5 Credit Added"/>
        <input type="hidden" name="email" value="{{Auth::user()->email}}"/>
    </form>
</div>

<div class="col-sm-4 text-center fc-grey">
    <div class="dashboardSection" style="height:300px;margin-bottom:20px;">
        <h3 class="fc-white" style="margin:0;">$10</h3>
    </div>
    <form action="{{action('PaymentController@charge')}}" method="POST">
        {{ csrf_field() }}
        <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="pk_test_7AL8K2hvvfLEyVuLe6eLL1jE"
        data-amount="1000"
        data-name="Pick6"
        data-description="Add $10 of Credit"
        data-image="/img/pick6_128.jpg"
        data-locale="auto"
        data-label="Select"
        data-email="{{Auth::user()->email}}"
        data-zip-code="true">
        </script>
        <input type="hidden" name="amount" value="1000"/>
        <input type="hidden" name="description" value="$10 Credit Added"/>
        <input type="hidden" name="email" value="{{Auth::user()->email}}"/>
    </form>
</div>

<div class="col-sm-4 text-center fc-grey">
    <div class="dashboardSection" style="height:300px;margin-bottom:20px;">
        <h3 class="fc-white" style="margin:0;">$20</h3>
    </div>
    <form action="{{action('PaymentController@charge')}}" method="POST">
        {{ csrf_field() }}
        <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="pk_test_7AL8K2hvvfLEyVuLe6eLL1jE"
        data-amount="2000"
        data-name="Pick6"
        data-description="Add $20 of Credit"
        data-image="/img/pick6_128.jpg"
        data-locale="auto"
        data-label="Select"
        data-email="{{Auth::user()->email}}"
        data-zip-code="true">
        </script>
        <input type="hidden" name="amount" value="2000"/>
        <input type="hidden" name="description" value="$20 Credit Added"/>
        <input type="hidden" name="email" value="{{Auth::user()->email}}"/>
    </form>
</div>

<!-- <div class="text-center col-sm-12" style="font-family: 'Montserrat', sans-serif;margin-top:40px;">
    <form action="{{action('PaymentController@charge')}}" method="post" id="payment-form">
        {!! csrf_field() !!}
        <div class="form-row">
            <label for="card-element">
                Credit or debit card
            </label>
            <div id="card-element">

            </div>


            <div id="card-errors" role="alert"></div>
        </div>

        <button type="submit">Submit Payment</button>
    </form>
</div> -->

@stop
