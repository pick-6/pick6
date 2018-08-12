<h1 class="text-center fc-yellow">
    Final Score
</h1>

<!-- Home Team Score -->
<div class="col-xs-6 text-center">
    <h2 class="fc-white" style="font-size: 2.5rem">
        <img src="/img/team_logos/{{$homeLogo}}" height="90" width="90" class="margin-bottom-10"><br>
        {{$homeTeam}}<br>
        <span class="fc-yellow" style="font-size: 5rem">{{$homeScore}}</span>
    </h2>
</div>

<!-- Away Team Score -->
<div class="col-xs-6 text-center">
    <h2 class="fc-white"  style="font-size: 2.5rem">
        <img src="/img/team_logos/{{$awayLogo}}" height="90" width="90" class="margin-bottom-10"><br>
        {{$awayTeam}}<br>
        <span class="fc-yellow" style="font-size: 5rem">{{$awayScore}}</span>
    </h2>
</div>

@if($hasWinnings && !$gameCancel)
    <!-- Winning User -->
    <div class="text-center">
        @if($hasWinningUser)
            <h2 class="fc-white">
                Winning User:<br>
                <span class="fc-yellow">
                    <a href="{{action('AccountController@show', $winningUserId)}}">{{$winningUserFullName}}</a>
                </span>
            </h2>
            <h2 class="fc-white">
                {{ Auth::id() == $winningUserId ? 'You' : ''}} Won a Total of:<br>
                <span class="fc-yellow">{{$total}}</span>
            </h2>
        @endif
    </div>

@endif

@if(!$gameCancel)
    <!-- See Table Button -->
    <div class="text-center clear" style="padding-top: 15px;">
        <button href="#gameTableModal" data-toggle="modal" class="btn btn-lg gameBtn" style="min-width:175px;">See Table</button>
        @include('game.modals.gameTableModal')
    </div>
@endif
