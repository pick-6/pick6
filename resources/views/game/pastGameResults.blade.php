<?php
    $homeTeam = $thisGame[0]['home'];
    $homeScore = $thisGame[0]['home_score'];
    $homeLogo = $thisGame[0]['home_logo'];
    $awayTeam = $thisGame[0]['away'];
    $awayScore = $thisGame[0]['away_score'];
    $awayLogo = $thisGame[0]['away_logo'];
    $winningUserId = $winningSelection[0]['winning_user'];
    $winningUser = $winningSelection[0]['first_name'] . " " .$winningSelection[0]['last_name'];
    $winningTotal = $winningSelection[0]['winning_total'];
?>

<h1 class="text-center" style="color: #fed136">
    Final Score
</h1>

<!-- Home Team Score -->
<div class="col-md-6 text-center">
    <h2 style="color: white">
        <img src="/img/team_logos/{{$homeLogo}}" height="90" width="90" style="margin-bottom: 10px"><br>
        {{$homeTeam}}: <br>
        <span style="color: #FEC503;font-size: 2em">{{$homeScore}}</span>
    </h2>
</div>

<!-- Away Team Score -->
<div class="col-md-6 text-center">
    <h2 style="color: white">
        <img src="/img/team_logos/{{$awayLogo}}" height="90" width="90" style="margin-bottom: 10px"><br>
        {{$awayTeam}}: <br>
        <span style="color: #FEC503;font-size: 2em">{{$awayScore}}</span>
    </h2>
</div>

<!-- Winning User -->
<div class="text-center">
    @if (Auth::user()->id == $winningUserId)
    <a href="/gameResults" class="btn btn-xl dropdown-toggle gameBtn" type="button">You Won!</a>
    @else
    <h2 style="color: white">Winning User:<br> <span style="color: #FEC503">{{$winningUser}}</span></h2>
    @endif
    <h2 style="color: white">A total of <span style="color: #FEC503">${{$winningTotal}}</span></h2>
</div>