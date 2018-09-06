<!-- Choose Another Game Modal -->
<div id="chooseAnotherGame" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-center closeModalBtnContainer">
                <button type="button" class="close btn closeModalBtn" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="playGamePage">
                    <h3 class="fc-white text-center margin-top-0">Games for the Week</h3>
                    @include('game.list', ['dates' => $datesForWeek])
                </div>
            </div>
            <div class="text-right margin-top-0 margin-bottom-15 margin-right-20 clear">
                <button class="btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
