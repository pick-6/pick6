<!-- Show No Funds Modal -->
<div id="showNoFundsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center closeModalBtnContainer">
                <button class="close btn closeModalBtn" data-dismiss="modal">×</button>
                <h3 class="fc-grey">Timeout... you are out of credit.</h3>
            </div>
            <div class="modal-body text-center">
                <div>
                    <h3 class="fc-grey margin-top-0 margin-bottom-20">Would you like to add more?</h3>
                    @include('partials.payment')
                    <div class="text-right margin-top-20 clear">
                        <button class="btn" data-dismiss="modal">No, thanks</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
