<!-- Game Table Modal -->
<div id="gameTableModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-center closeModalBtnContainer">
                <button class="close btn closeModalBtn" data-dismiss="modal">&times</button>
            </div>
            <div class="modal-body text-center fc-grey">
                <!-- HOME TEAM NAME -->
                <div class="col-xs-12 homeTeamName">
                    <h1 class="text-center margin-top-0 fc-white margin-bottom-0">
                        {{$homeTeam}}
                        <img src="/img/team_logos/{{$homeLogo}}" width="40" height="35">
                    </h1>
                    <div class="text-center homeTeamTop fc-white margin-bottom-5">
                        (Top of the table)
                    </div>
                </div>

                @include('game.gameTable')

                <!-- AWAY TEAM NAME FOR MOBILE, TABLET (shows below the table) -->
                <div class="col-xs-12 awayTeamName fc-white">
                    <h1 class="text-center margin-bottom-0 margin-top-5">
                        {{$awayTeam}}
                        <img src="/img/team_logos/{{$awayLogo}}" width="40" height="35">
                    </h1>
                    <div class="text-center fc-white">
                        (Left side of the table)
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
