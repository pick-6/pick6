<style>
    #paymentBtns span.dollar {
        font-size: 25px;
        color: #fff;
        position: absolute;
        top: 20px;
        font-weight: bold;
        left: 70px;
    }
    @media(max-width:991px){
        #paymentBtns span.dollar {
            top: 16px;
        }
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
</style>

<div id="paymentBtns" class="paymentBtns inline-block width100">
    <form id="payForm" method="post" action="{{action('PaymentController@freeCharge')}}">
        {{ csrf_field() }}
        <div class="col-xs-4 fc-grey">
            <a class="addCredit" data-amount="10">
                <i class="fas fa-money-bill-wave"></i>
                <span class="dollar dollar10">$10</span>
            </a>
        </div>
        <div class="col-xs-4 fc-grey">
            <a class="addCredit" data-amount="20">
                <i class="fas fa-money-bill-wave"></i>
                <span class="dollar dollar10">$20</span>
            </a>
        </div>
        <div class="col-xs-4 fc-grey">
            <a class="addCredit" data-amount="50">
                <i class="fas fa-money-bill-wave"></i>
                <span class="dollar dollar10">$50</span>
            </a>
        </div>
    </form>
</div>
