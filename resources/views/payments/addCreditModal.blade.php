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
</style>

<!-- Add Credit Modal -->
<div id="addCreditModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-center closeModalBtnContainer">
                <button class="close btn closeModalBtn" data-dismiss="modal">&times</button>
            </div>
            <div class="modal-body text-center">
                <div>
                    <h3 class="fc-grey margin-0-auto">Select an amount to add</h3>
                </div>
                @include('payments.payment-free')
                <!-- @include('payments.payment') -->
                <!-- @include('payments.payment-paypal') -->
                <div class="text-right margin-top-20 clear">
                    <button class="btn" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
