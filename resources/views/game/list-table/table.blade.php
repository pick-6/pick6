<?php
    use Carbon\Carbon;
    use \App\Http\Controllers\GamesController;

    $showTime = $showTime ?? true;
    $showBtn = $showBtn ?? true;
    $showGameId = $showGameId ?? false;
    $showPrice = !$gamesAreFree ?? $showPrice ?? true;
    $showTeamName = $showTeamName ?? true;
    $showCity = $showCity ?? true;


    $gameOver = $gameOver ?? false;
    $gameCancel = $gameCancel ?? false;
    $gameStarted = $gameStarted ?? false;


    $isNextWeekList = $isNextWeekList ?? false;
    $showTimeZone = $showTimeZone ?? $showGameTime ?? false;
    $onDash = $onDash ?? false;
    $showWinner = $showWinner ?? false;
?>

<table class="col-sm-12 table-bordered table-condensed gamesForWeekTables">
    @if ($isNextWeekList)
        <colgroup>
            <col style="width: {{$showTime ? 10 : 75}}%">
            <col>
            <col style="width: 25%">
        </colgroup>
    @else
        <colgroup>
            @if ($onDash)
                <col>
                <col style="width: 35%">
            @else
                <col style="width: 10%">
                <col>
                <col style="width: 25%">
            @endif
        </colgroup>
    @endif
    <tbody>
        @foreach($games as $game)
        <?php
            $gameId = $game->game_id ?? $game->id;
            $gameTime = $game->date_for_week . ' ' . $game->time;
            $gameStarted = $gameTime <= Carbon::now('America/New_York');
            $gameOver = !is_null($game->home_score) || !is_null($game->away_score);
            $numberOfPicks = GamesController::numberOfPicksForGame($gameId);
            $gameCancel = $numberOfPicks < $minGamePicks && $gameStarted;
            $noTeams = $game->home == "TBD" && $game->away == "TBD";
            $noHomeTeam = $game->home == "TBD" && $game->away != "TBD";
            $noAwayTeam = $game->away == "TBD" && $game->home != "TBD";
        ?>
        @if ($dates ? $date->date_for_week == $game->date_for_week : true)
            <tr>
                @if($showTime)
                    @if($gameOver)
                        <td class="gameDayTime fc-yellow" style="padding:5px;text-align:center;">
                            @if($showGameId)
                                <div class="gameId">
                                    <div class="gameId-ribbon-wrapper">
                                        <div class="gameId-ribbon"><small class="fc-red">Id: {{$gameId}}</small></div>
                                    </div>
                                </div>
                            @endif
                            <div class="gameTime fs-18">
                                FINAL
                            </div>
                        </td>
                    @else
                        <td class="gameDayTime" data-title="Kick-Off">
                            @if ($showPrice && (!$gameOver && !$gameCancel && !$gameStarted))
                                <div class="gamePrice">
                                    <div class="gamePrice-ribbon-wrapper">
                                        <div class="gamePrice-ribbon">{{ str_replace(".00","",money_format('$%i',$game->pick_cost)) }}</div>
                                    </div>
                                </div>
                            @endif
                            @if($showGameId)
                                <div class="gameId">
                                    <div class="gameId-ribbon-wrapper">
                                        <div class="gameId-ribbon"><small class="fc-red">Id: {{$gameId}}</small></div>
                                    </div>
                                </div>
                            @endif
                            <div class="gameTime">
                                @if (is_null($game->time))
                                    TBD
                                @else
                                    {{date("g:i", strtotime("$game->time"))}} <small>{{date("A", strtotime("$game->time"))}}</small>
                                @endif
                            </div>
                        </td>
                    @endif
                @endif
                <td class="gameTeams text-left padding-0">
                    @if ($isNextWeekList || !$showTime)
                        @if ($showPrice && (!$gameOver && !$gameCancel && !$gameStarted))
                            <div class="gamePrice">
                                <div class="gamePrice-ribbon-wrapper">
                                    <div class="gamePrice-ribbon">{{ str_replace(".00","",money_format('$%i',$game->pick_cost)) }}</div>
                                </div>
                            </div>
                        @endif
                        @if($showGameId)
                            <div class="gameId">
                                <div class="gameId-ribbon-wrapper">
                                    <div class="gameId-ribbon"><small class="fc-red">Id: {{$gameId}}</small></div>
                                </div>
                            </div>
                        @endif
                    @endif
                    <a data-game-id="{{$gameId}}" class="{{$gameOver ? 'fs-30' : ($isNextWeekList || $onDash ? 'fs-12' : 'fs-16')}} {{$gameCancel ? 'forGameCancel' : '' }}" data-role-ajax="{{$gameCancel ? '/cancel' : '/play'}}">
                        <div class="pull-left width50 {{ $noTeams || $noHomeTeam ? 'text-center' : '' }} homeTeam padding-10">
                            @if($game->home != 'TBD')
                                <img data-role="teamLogo" data-team-id="{{$game->homeId}}" src="/img/team_logos/{{$game->home_logo}}" height="{{$onDash ? 30 : 60}}" width="{{$onDash ? 35 : 65}}" alt="{{$game->home}}">
                                <div class="text-left middle inline-flex" style="width:calc(100% - {{$onDash ? 45 : 75}}px)">
                                    <span class="{{($game->home_score > $game->away_score) && $showWinner ? 'bold' : ''}}">
                                        {{$gameOver ? $game->home_score : ($showTeamName ? ($showCity ? $game->home_city." ".$game->home : $game->home) : "")}}
                                    </span>
                                    @if(($game->home_score > $game->away_score) && $showWinner)
                                    <span class="fs-16 margin-left-10 margin-top-10" style="color: sienna;">
                                            <i class="fas fa-football-ball" style="transform: rotate(45deg);"></i>
                                        </span>
                                    @endif
                                </div>
                            @else
                                <span class="fs-20 middle text-center" style="line-height: 60px;">TBD</span>
                            @endif
                        </div>
                        <div class="pull-right width50 {{ $noTeams || $noAwayTeam ? 'text-center' : '' }} awayTeam padding-10">
                            @if($game->away != 'TBD')
                                <img data-role="teamLogo" data-team-id="{{$game->awayId}}" src="/img/team_logos/{{$game->away_logo}}" height="{{$onDash ? 30 : 60}}" width="{{$onDash ? 35 : 65}}" alt="{{$game->away}}">
                                <div class="text-left middle inline-flex" style="width:calc(100% - {{$onDash ? 45 : 75}}px)">
                                    <span class="{{($game->away_score > $game->home_score) && $showWinner ? 'bold' : ''}}">
                                        {{$gameOver ? $game->away_score : ($showTeamName ? ($showCity ? $game->away_city." ".$game->away : $game->away) : "")}}
                                    </span>
                                    @if(($game->away_score > $game->home_score) && $showWinner)
                                        <span class="fs-16 margin-left-10 margin-top-10" style="color: sienna;">
                                            <i class="fas fa-football-ball" style="transform: rotate(45deg);"></i>
                                        </span>
                                    @endif
                                </div>
                            @else
                                <span class="fs-20 middle text-center" style="line-height: 60px;">TBD</span>
                            @endif
                        </div>
                    </a>
                </td>
                @if($showBtn || $showPicksAvail)
                    <td id="playGameBtn" style="padding: 0px;{{$showPicksAvail ? 'padding-bottom:10px;' : ''}}">
                        @if($showBtn)
                            <a data-game-id="{{$gameId}}" data-role-ajax="{{$gameCancel ? '/cancel' : '/play'}}" class="btn playGameBtn {{$gameCancel ? 'forGameCancel' : '' }}" style="min-width:85%;">
                                @if($gameOver)
                                    @if($gameCancel)
                                        CANCELLED
                                    @else
                                        SEE RESULTS
                                    @endif
                                @else
                                    @if ($numberOfPicks < 100 && !$gameStarted)
                                        {{(in_array("$gameId", $playingIn)) ? 'GO TO GAME' : 'JOIN GAME'}}
                                    @elseif ($gameCancel)
                                        CANCELLED
                                    @else
                                        SEE TABLE
                                    @endif
                                @endif
                            </a>
                        @endif
                        @if ($showPicksAvail)
                            @include('game.availPicksBar',
                            [
                                'picksMade' => $numberOfPicks,
                                'isGameOver' =>  $gameOver,
                                'isGameStarted' => $gameStarted,
                                'isGameCancel' => $gameCancel
                            ])
                        @endif
                    </td>
                @endif
            </tr>
        @endif
        @endforeach
    </tbody>
</table>
