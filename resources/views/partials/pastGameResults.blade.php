<h1 class="text-center" style="color: #fed136">
    Final Score
</h1>

<!-- Home Team Score -->
<div class="col-md-6 text-center">
    <h2 style="color: white">
        <img src="/img/team_logos/{{$thisGame[0]['home_logo']}}" height="90" width="90" style="margin-bottom: 10px"><br>
        {{$thisGame[0]['home']}}: <br>
        <span style="color: #FEC503;font-size: 2em">{{$thisGame[0]['home_score']}}</span>
    </h2>
</div>

<!-- Away Team Score -->
<div class="col-md-6 text-center">
    <h2 style="color: white">
        <img src="/img/team_logos/{{$thisGame[0]['away_logo']}}" height="90" width="90" style="margin-bottom: 10px"><br>
        {{$thisGame[0]['away']}}: <br>
        <span style="color: #FEC503;font-size: 2em">{{$thisGame[0]['away_score']}}</span>
    </h2>
</div>

<!-- Winning User -->
<div class="text-center">
    @foreach ($winningSelection as $winningUser)
        @if (Auth::user()->id == $winningUser->winning_user)
            <a href="/gameResults" class="btn btn-xl dropdown-toggle gameBtn" type="button">You Won!</a>
            @foreach ($winningCharitySelection as $winningCharity)
                    <h2 style="color: white">A total of <span style="color: #FEC503">${{$winningCharity->winning_total}}</span></h2>
            @endforeach
        @else
                <h2 style="color: white">Winning User:<br> <span style="color: #FEC503">{{$winningUser->first_name}} {{$winningUser->last_name}}</span></h2>
            @foreach ($winningCharitySelection as $winningCharity)
                    <h2 style="color: white;width: 70%;margin:0 auto;">A total of <span style="color: #FEC503">${{$winningCharity->winning_total}}</span> went to <span style="color: #FEC503">{{$winningCharity->name}}</span></h2>
            @endforeach
        @endif
    @endforeach
</div>
