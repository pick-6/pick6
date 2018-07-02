<!-- Game/Pot Details Modal -->
<div id="gameDetails" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-center closeModalBtnContainer">
                <button class="close btn closeModalBtn" data-dismiss="modal">&times</button>
            </div>
            <div class="modal-body text-center fc-grey">
                <div class="text-center fc-grey">
                    <div>
                        Money in the Game: <span id="moneyInGame">{{$moneyInGame}}</span>
                    </div>
                    <div>
                        Current Pot: <span id="pot">{{$potAmount}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
