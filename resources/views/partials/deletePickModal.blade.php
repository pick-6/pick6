<style>
    #deletePickModal .modal-content {
        background-color:#222;
    }
    #deletePickModal .modal-body h3 {
        margin-top: 0px;
    }
    #deletePickModal .modal-body {
        padding-top: 0px;
    }
    #deletePickModal .closeModalBtnContainer {
        height: 20px;
    }
    #deletePickModal .closeModalBtn {
        padding: 0 5px;
    }
    #deletePickModal .modal-dialog {
        transform: translateY(30vh);
        margin: 10px;
    }
    @media (min-width: 645px){
        #deletePickModal .modal-dialog {
            width: 75%;
            margin: 0 auto;
        }
    }
    @media (min-width: 768px){
        #deletePickModal .modal-dialog {
            width: 500px;
        }
    }
</style>

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
