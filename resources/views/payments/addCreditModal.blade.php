<style>
    #addCreditModal .modal-dialog {
        transform: translateY(20vh);
    }
    #addCreditModal .modal-content {
        background-color:#222;
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
    @media(max-width:425px){
        #addCreditModal .modal-body h3 {
            width: 75%;
            margin: 0 auto;
        }
    }
</style>

<!-- Add Credit Modal -->
<div id="addCreditModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-center closeModalBtnContainer">
                <button class="close btn closeModalBtn" data-dismiss="modal">&times</button>
            </div>
            <div class="modal-body text-center">
                <div class="fc-yellow italic margin-bottom-10">
                    <small>* Limited Time Only * -- All Credit is Free!</small>
                </div>
                <div>
                    <h3 class="fc-grey margin-0-auto margin-bottom-15">Select an amount to add</h3>
                </div>
                <div id="paymentBtns" class="paymentBtns inline-block width100">
                    <form id="payForm" method="post" action="{{action('PaymentController@freeCharge')}}">
                        {{ csrf_field() }}
                        @include('payments.payment-options')
                    </form>
                </div>
                <div class="text-right margin-top-20 clear">
                    <button class="btn" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
