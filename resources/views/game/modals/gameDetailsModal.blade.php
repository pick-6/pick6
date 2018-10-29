<!-- Game/Pot Details Modal -->
<div id="gameDetails" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-center closeModalBtnContainer">
                <button class="close btn closeModalBtn" data-dismiss="modal">&times</button>
            </div>
            <div class="modal-body text-center fc-grey">
                <div class="text-center fc-grey fs-18">
                    <div>
                        Total Game Pot: <span id="pot" class="fc-yellow">{{$potAmount}}</span>
                    </div>
                    <div>
                        Your Total Stake: <span id="moneyInGame" class="fc-red">{{$moneyInGame}}</span>
                    </div>
                    <div>
                        Potential Profit: <span id="potEarnings" class="fc-green">{{$potentialEarnings}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
