<!-- Game Table Modal -->
<div id="gameTableModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-center closeModalBtnContainer">
                <button class="close btn closeModalBtn" data-dismiss="modal">&times</button>
            </div>
            <div class="modal-body text-center fc-grey">
                <!-- <img src="/img/team_logos/{{$homeLogo}}" width="45" height="45">
                <span class="fs-18">
                    {{$homeTeam}}
                </span> -->
                @include('game.gameTable')
                <!-- <img src="/img/team_logos/{{$awayLogo}}" width="45" height="45">
                <span class="fs-18">
                    {{$awayTeam}}
                </span> -->
            </div>
        </div>
    </div>
</div>
