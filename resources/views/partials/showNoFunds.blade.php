<style>
    #showNoFundsModal .modal-content {
        background-color:#222;
    }
    #showNoFundsModal .modal-body h3 {
        margin-top: 0px;
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
                    <h3 class="fc-grey">Would you like to add more?</h3>
                    <div class="inline-block width100">
                        <div class="col-sm-4 fc-grey">
                            $5
                            <form action="{{action('PaymentController@charge')}}" method="POST">
                                {{ csrf_field() }}
                                <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="pk_test_7AL8K2hvvfLEyVuLe6eLL1jE"
                                data-amount="500"
                                data-description="Add $5 of Credit"
                                data-locale="auto"
                                data-label="Add $5"
                                data-email="{{Auth::user()->email}}"
                                data-zip-code="true">
                                </script>
                                <input type="hidden" name="amount" value="500"/>
                                <input type="hidden" name="description" value="$5 Credit Added"/>
                                <input type="hidden" name="email" value="{{Auth::user()->email}}"/>
                            </form>
                        </div>
                        <div class="col-sm-4 fc-grey">
                            $10
                            <form action="{{action('PaymentController@charge')}}" method="POST">
                                {{ csrf_field() }}
                                <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="pk_test_7AL8K2hvvfLEyVuLe6eLL1jE"
                                data-amount="1000"
                                data-description="Add $10 of Credit"
                                data-locale="auto"
                                data-label="Add $10"
                                data-email="{{Auth::user()->email}}"
                                data-zip-code="true">
                                </script>
                                <input type="hidden" name="amount" value="1000"/>
                                <input type="hidden" name="description" value="$10 Credit Added"/>
                                <input type="hidden" name="email" value="{{Auth::user()->email}}"/>
                            </form>
                        </div>
                        <div class="col-sm-4 fc-grey">
                            $20
                            <form action="{{action('PaymentController@charge')}}" method="POST">
                                {{ csrf_field() }}
                                <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="pk_test_7AL8K2hvvfLEyVuLe6eLL1jE"
                                data-amount="2000"
                                data-description="Add $20 of Credit"
                                data-locale="auto"
                                data-label="Add $20"
                                data-email="{{Auth::user()->email}}"
                                data-zip-code="true">
                                </script>
                                <input type="hidden" name="amount" value="2000"/>
                                <input type="hidden" name="description" value="$20 Credit Added"/>
                                <input type="hidden" name="email" value="{{Auth::user()->email}}"/>
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
