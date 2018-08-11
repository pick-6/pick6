<?php
    $homeTeam = $thisGame[0]['home'];
    $homeScore = $thisGame[0]['home_score'];
    $homeLogo = $thisGame[0]['home_logo'];
    $awayTeam = $thisGame[0]['away'];
    $awayScore = $thisGame[0]['away_score'];
    $awayLogo = $thisGame[0]['away_logo'];
?>

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
            <?php
                $winningUserId = $gameWinnings[0]['winning_user'];
                $winningUserName = $winningUser[0]['first_name'] . " " .$winningUser[0]['last_name'];
                $winningTotal = $gameWinnings[0]['winning_total'];
                $total = str_replace(".00","",money_format('$%i',$winningTotal));
            ?>
            <h2 class="fc-white">
                Winning User:<br>
                <span class="fc-yellow">
                    @if (Auth::id() == $winningUserId)
                        You Won!
                    @else
                        <a href="{{action('AccountController@show', $winningUserId)}}">{{$winningUserName}}</a>
                    @endif
                </span>
            </h2>
            <h2 class="fc-white">
                Won a Total of:<br>
                <span class="fc-yellow">{{$total}}</span>
            </h2>
        @else
            <?php
                $winningTotal = $gameWinnings[0]['winning_total'];
                $total = str_replace(".00","",money_format('$%i',$winningTotal));
            ?>
            <h2 class="fc-white">Winning User:<br> <span class="fc-yellow">None</span></h2>
            <h2 class="fc-white">
                A Total of <span class="fc-yellow">{{$total}}</span> goes to the house.
            </h2>
        @endif
    </div>

    <!-- See Table Button -->
    <div class="text-center clear" style="padding-top: 30px;">
        <button href="#gameTableModal" data-toggle="modal" class="btn btn-lg gameBtn" style="min-width:175px;">See Table</button>
        @include('game.modals.gameTableModal')
    </div>
@endif
