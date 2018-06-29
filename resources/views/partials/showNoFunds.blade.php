<style>
    #showNoFundsModal .modal-content {
        background-color:#222;
    }
    #showNoFundsModal .modal-body h3 {
        margin-top: 0px;
    }
    #showNoFundsModal .modal-dialog {
        transform: translateY(25vh);
    }
    #showNoFundsModal button.stripe-button-el {
        display: none;
    }
    #showNoFundsModal .addCredit {
        font-size: 4em;
        color: mediumseagreen;
    }
    #showNoFundsModal .addCredit:hover {
        color: seagreen;
    }
    #showNoFundsModal .addCredit:hover {
        cursor: pointer;
    }
</style>

<!-- Show No Funds Modal -->
<div id="showNoFundsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h3 class="fc-grey" style="display:inline">Timeout... you are out of credit.</h3>
                <button class="close btn" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body text-center">
                <div>
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
                    <h3 class="fc-grey">Would you like to add more?</h3>
                    <div class="inline-block width100 margin-top-10">
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
                    <div class="text-right margin-top-20 clear">
                        <button class="btn" data-dismiss="modal">No, thanks</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $this = $('#showNoFundsModal');

    $this.find('.addCredit').on('click', function(e){
        $(this).siblings().find('button.stripe-button-el').trigger('click');
    });
</script>
