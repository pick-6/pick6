<style>
    #paymentBtns span.dollar {
        font-size: 25px;
        color: #fff;
        position: absolute;
        top: 12px;
        font-weight: bold;
        left: 70px;
    }
    #paymentBtns button.stripe-button-el {
        display: none;
    }
    #paymentBtns .addCredit i {
        font-size: 4em;
    }
    #paymentBtns .addCredit {
        color: mediumseagreen;
    }
    #paymentBtns .addCredit:hover {
        color: seagreen;
        cursor: pointer;
    }
</style>

<div id="paymentBtns" class="paymentBtns inline-block width100">
    <div class="col-sm-4 fc-grey">
        <a class="addCredit" data-amount="10">
            <i class="fas fa-money-bill-wave"></i>
            <span class="dollar dollar10">$10</span>
        </a>
        <form id="payForm" action="{{action('PaymentController@charge', 10)}}" method="POST">
            {{ csrf_field() }}
            <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="pk_test_7AL8K2hvvfLEyVuLe6eLL1jE"
            data-amount="1000"
            data-description="Add $10 of Credit"
            data-locale="auto"
            data-email="{{Auth::user()->email}}"
            data-zip-code="true">
            </script>
            <input type="hidden" name=description value="{{Auth::user()->first_name}} {{Auth::user()->last_name}} added $10"/>
        </form>
    </div>
    <div class="col-sm-4 fc-grey">
        <a class="addCredit" data-amount="20">
            <i class="fas fa-money-bill-wave"></i>
            <span class="dollar dollar20">$20</span>
        </a>
        <form id="payForm" action="{{action('PaymentController@charge', 20)}}" method="POST">
            {{ csrf_field() }}
            <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="pk_test_7AL8K2hvvfLEyVuLe6eLL1jE"
            data-amount="2000"
            data-description="Add $20 of Credit"
            data-locale="auto"
            data-email="{{Auth::user()->email}}"
            data-zip-code="true">
            </script>
            <input type="hidden" name=description value="{{Auth::user()->first_name}} {{Auth::user()->last_name}} added $20"/>
        </form>
    </div>
    <div class="col-sm-4 fc-grey">
        <a class="addCredit" data-amount="50">
            <i class="fas fa-money-bill-wave"></i>
            <span class="dollar dollar50">$50</span>
        </a>
        <form id="payForm" action="{{action('PaymentController@charge', 50)}}" method="POST">
            {{ csrf_field() }}
            <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="pk_test_7AL8K2hvvfLEyVuLe6eLL1jE"
            data-amount="5000"
            data-description="Add $50 of Credit"
            data-locale="auto"
            data-email="{{Auth::user()->email}}"
            data-zip-code="true">
            </script>
            <input type="hidden" name=description value="{{Auth::user()->first_name}} {{Auth::user()->last_name}} added $50"/>
        </form>
    </div>
</div>
