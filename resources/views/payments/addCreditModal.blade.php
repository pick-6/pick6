<!-- Add Credit Modal -->
<div id="addCreditModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-center closeModalBtnContainer">
                <button class="close btn closeModalBtn" data-dismiss="modal">&times</button>
            </div>
            <div class="modal-body text-center">
                <div>
                    <h3 class="fc-grey margin-0-auto margin-bottom-15">Select an amount to add</h3>
                </div>
                <div id="paymentBtns" class="paymentBtns inline-block width100">
                    <form id="payForm" method="post" action="">
                        {{ csrf_field() }}
                        @include('payments.payment-options')
                    </form>
                </div>
                <div class="text-right margin-top-20 clear">
                    <button id="closeAddCreditModal" class="btn" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
