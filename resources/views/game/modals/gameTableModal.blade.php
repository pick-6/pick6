<!-- Game Table Modal -->
<div id="gameTableModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-center closeModalBtnContainer">
                <button class="close btn closeModalBtn" data-dismiss="modal">&times</button>
            </div>
            <div class="modal-body text-center fc-grey">
                @include('game.gameTable')
            </div>

            <div class="text-right margin-top-10 clear" style="margin-right:20px">
                <button class="btn" data-dismiss="modal">Close</button>
            </div>

            @if(Auth::user()->email == 'mattvaldez01@gmail.com')
                <div class="fc-red absolute" style="bottom:10px;left:15px;">
                    Game Id: {{$gameId}}
                </div>
            @endif
        </div>
    </div>
</div>
