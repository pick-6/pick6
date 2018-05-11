<h1 class="text-center" style="color: white">
    Final Score
</h1>

<!-- Home Team Score -->
<div class="col-md-6 text-center">
    <h2 style="color: white">
        {{$thisGame->home}}: <br>
        <span style="color: #FEC503">{{$thisGame->home_score}}</span>
    </h2>
</div>

<!-- Away Team Score -->
<div class="col-md-6 text-center">
    <h2 style="color: white">
        {{$thisGame->away}}: <br>
        <span style="color: #FEC503">{{$thisGame->away_score}}</span>
    </h2>
</div>

<!-- Winning User -->
<div class="text-center">
    @if (Auth::user()->id == $thisGame->winning_user)
        <a href="/gameResults" class="btn btn-xl dropdown-toggle gameBtn" type="button">You Won!</a>
    @else
        @foreach ($winningSelection as $winningUser)
            <h2 style="color: white">Winning User:<br> <span style="color: #FEC503">{{$winningUser->first_name}} {{$winningUser->last_name}}</span></h2>
        @endforeach
        @foreach ($winningCharitySelection as $winningCharity)
                <h2 style="color: white">A total of <span style="color: #FEC503">${{$winningCharity->winning_total}}</span> went to <span style="color: #FEC503">{{$winningCharity->name}}</span></h2>
        @endforeach
    @endif
</div>
