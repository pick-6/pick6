<style>
    #addCreditModal .modal-dialog {
        transform: translateY(20vh);
    }
    #addCreditModal button.stripe-button-el {
        display: none;
    }
    #addCreditModal .addCredit {
        font-size: 4em;
        color: mediumseagreen;
    }
    #addCreditModal .addCredit:hover {
        color: seagreen;
    }
    #addCreditModal .addCredit:hover {
        cursor: pointer;
    }
    #addCreditModal .closeModalBtnContainer {
        height: 20px;
    }
    #addCreditModal .closeModalBtn {
        padding: 0 5px;
    }
    #addCreditModal .modal-content {
        background-color:#222;
    }
    #addCreditModal .modal-body h3 {
        margin-top: 0px;
    }
    #addCreditModal .modal-body {
        padding-top: 0px;
    }
    #addCreditModal .closeModalBtnContainer {
        height: 20px;
    }
    #addCreditModal .closeModalBtn {
        padding: 0 5px;
    }
</style>

<!-- Show No Funds Modal -->
<div id="addCreditModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-center closeModalBtnContainer">
                <button class="close btn closeModalBtn" data-dismiss="modal">&times</button>
            </div>
            <div class="modal-body text-center">
                <div>
                    <h3 class="fc-grey inline">Select an amount to add</h3>
                </div>
                <style>
                span.dollar {
                    font-size: 25px;
                    color: #fff;
                    position: absolute;
                    top: 21px;
                    font-weight: bold;
                }
                span.dollar5 {
                    left: 78px;
                }
                span.dollar10 {
                    left: 72px;
                }
                span.dollar20 {
                    left: 70px;
                }
                </style>
                <div class="inline-block width100 margin-top-20">
                    <div class="col-sm-4 fc-grey">
                        <a class="addCredit" data-amount="5">
                            <i class="fas fa-money-bill-wave"></i>
                            <span class="dollar dollar5">$5</span>
                        </a>
                        <form id="payForm" action="{{action('PaymentController@charge', 5)}}" method="POST">
                            {{ csrf_field() }}
                            <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="pk_test_7AL8K2hvvfLEyVuLe6eLL1jE"
                            data-amount="500"
                            data-description="Add $5 of Credit"
                            data-locale="auto"
                            data-email="{{Auth::user()->email}}"
                            data-zip-code="true">
                            </script>
                            <input type="hidden" name=description value="{{Auth::user()->first_name}} {{Auth::user()->last_name}} added $5"/>
                        </form>
                    </div>
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
                        </form>
                    </div>
                </div>
                <div class="text-right margin-top-10 clear">
                    <button class="btn" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
