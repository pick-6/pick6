<!-- Delete Pick Modal -->
<div id="deletePickModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-center closeModalBtnContainer">
                <button class="close btn closeModalBtn" data-dismiss="modal">&times</button>
            </div>
            <div class="modal-body text-center">
                <div>
                    <h3 class="fc-grey inline">Are you sure you want to delete your pick?</h3>
                </div>
                <div>
                    <form id="deletePickForm" method="POST" action="{{ action('SelectionsController@destroy') }}">
                        {{method_field('DELETE')}}
                        {!! csrf_field() !!}
                        <div class="text-right margin-top-20 clear">
                            <button id="deletePickBtn" class="btn btn-success margin-right-10" type="submit">Yes, delete my pick</button>
                            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
