<!-- Game Started Modal -->
<div id="gameStartedModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-center closeModalBtnContainer">
                <button class="close btn closeModalBtn" data-dismiss="modal">&times</button>
            </div>
            <div class="modal-body text-center fc-grey">
                <div class="text-center fc-grey">
                    <div>
                        <h3>Sorry, the game {{ $gameOver ? "is over" : "has started" }}.</h3>
                    </div>
                    <div>
                        <h3>No more picks can be made.</h3>
                    </div>
                </div>
                <div class="text-right margin-top-20 clear">
                    <button style="min-width:80px;" class="btn btn-success" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>
