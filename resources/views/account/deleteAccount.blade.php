<!-- Delete Account Modal -->
<div id="deleteAccountModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-center closeModalBtnContainer">
                <button class="close btn closeModalBtn" data-dismiss="modal">&times</button>
            </div>
            <div class="modal-body text-center">
                <div>
                    <h2 class="fc-red margin-top-0">STOP! <i class="fas fa-hand-paper"></i></h2>
                    <h3 class="fc-yellow fs-20 width70 margin-0-auto">Are you sure you want to delete your account?</h3>
                    <div class="margin-top-10 uppercase" style="color:#aaa;">
                        This action can not be undone!
                    </div>
                    <div class="fc-grey margin-top-10">
                        All credit <span class="fc-yellow uppercase">will not</span> be refunded.
                    </div>
                    <div class="fc-grey">
                        All pick selections <span class="fc-yellow uppercase">will</span> be deleted.
                    </div>
                </div>
                <div>
                    <form id="deleteAccountForm" method="POST" action="{{action('AccountController@destroy')}}">
                        {{method_field('DELETE')}}
                        {!! csrf_field() !!}
                        <div class="text-right margin-top-20 clear">
                            <button id="deleteAccountBtn" class="btn btn-danger margin-right-15" type="submit">Yes, delete my account</button>
                            <button class="btn btn-cancel" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
