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
    @media(max-width:767px){
        #paymentBtns span.dollar {
            left: 38%;
        }
    }
    @media(max-width:540px){
        #paymentBtns span.dollar {
            left: 33%;
        }
    }
    @media(max-width:467px){
        #paymentBtns span.dollar {
            left: 28%;
        }
    }
    @media(max-width:425px){
        .modal-body h3 {
            width: 70%;
            margin: 0 auto;
        }
    }
</style>

<div id="paymentBtns" class="paymentBtns inline-block width100">
    <div class="col-xs-4 fc-grey">
        <form id="payForm" action="{{action('PaymentController@freeCharge', 10)}}" method="POST">
            {{ csrf_field() }}
            <a class="addCredit" data-amount="10">
                <i class="fas fa-money-bill-wave"></i>
                <span class="dollar dollar10">$10</span>
            </a>
        </form>
    </div>
    <div class="col-xs-4 fc-grey">
        <form id="payForm" action="{{action('PaymentController@freeCharge', 20)}}" method="POST">
            {{ csrf_field() }}
            <a class="addCredit" data-amount="20">
                <i class="fas fa-money-bill-wave"></i>
                <span class="dollar dollar10">$20</span>
            </a>
        </form>
    </div>
    <div class="col-xs-4 fc-grey">
        <form id="payForm" action="{{action('PaymentController@freeCharge', 50)}}" method="POST">
            {{ csrf_field() }}
            <a class="addCredit" data-amount="50">
                <i class="fas fa-money-bill-wave"></i>
                <span class="dollar dollar10">$50</span>
            </a>
        </form>
    </div>
</div>
