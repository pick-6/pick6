<?php
    use Carbon\Carbon;
    use \App\Http\Controllers\GamesController;
    use \App\Http\Controllers\SelectionsController;
?>

@foreach ($dates as $date)
    <h4 class="dateOfGame text-left clear fc-grey">
        <?=date("l, F j<\s\m\a\l\l><\s\up>S</\s\up></\s\m\a\l\l>", strtotime("$date->date_for_week"))?>
    </h4>
    <table class="col-sm-12 table-bordered table-condensed gamesForWeekTables">
            <colgroup>
                <col style="width: {{$showGameTime ? 10 : 75}}%">
                <col>
                <col style="width: 25%">
            </colgroup>
            <tbody>
                @foreach ($games as $game)
                    <?php
                        $gameTime = $game->date_for_week . ' ' . $game->time;
                        $gameStarted = $gameTime <= Carbon::now('America/New_York');
                        $gameOver = !is_null($game->home_score) || !is_null($game->away_score);
                        $numberOfPicks = GamesController::numberOfPicksForGame($game->id);
                        $gameCancel = $numberOfPicks < $minGamePicks && $gameStarted;
                        if ($gameCancel) {
                            SelectionsController::gameCancelled($game->id);
                        }
                    ?>
                        @if ($date->date_for_week == $game->date_for_week)
                            <tr>
                                @if($showGameTime)
                                    @if($gameOver)
                                        <td class="fs-18 fc-yellow" style="padding:5px;text-align:center;">
                                            FINAL
                                        </td>
                                    @else
                                        <td class="gameDayTime" data-title="Kick-Off">
                                            @if ($showPrice && (!$gameOver && !$gameCancel))
                                                <div class="gamePrice">
                                                    <div class="gamePrice-ribbon-wrapper">
                                                        <div class="gamePrice-ribbon">{{ str_replace(".00","",money_format('$%i',$game->pick_cost)) }}</div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($showGameId)
                                                <div class="gameId">
                                                    <div class="gameId-ribbon-wrapper">
                                                        <div class="gameId-ribbon"><small class="fc-red">Id: {{$game->id}}</small></div>
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
                                    @if ($isNextWeekList || !$showGameTime)
                                        @if ($showPrice && (!$gameOver && !$gameCancel))
                                            <div class="gamePrice">
                                                <div class="gamePrice-ribbon-wrapper">
                                                    <div class="gamePrice-ribbon">{{ str_replace(".00","",money_format('$%i',$game->pick_cost)) }}</div>
                                                </div>
                                            </div>
                                        @endif
                                        @if($showGameId)
                                            <div class="gameId">
                                                <div class="gameId-ribbon-wrapper">
                                                    <div class="gameId-ribbon"><small class="fc-red">Id: {{$game->id}}</small></div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    <a class="{{$gameOver ? 'fs-30' : ($isNextWeekList ? 'fs-12' : 'fs-16')}}" href="{{action('GamesController@show', [$game->id])}}">
                                        <div class="pull-left width50 homeTeam padding-10">
                                            <img src="/img/team_logos/{{$game->home_logo}}" height="60" width="65" alt="{{$game->home}}">
                                            <div class="text-left middle {{$gameOver ? '' : $isNextWeekList ? 'width50' : 'width60'}} inline-flex">
                                                {{$gameOver ? $game->home_score : ($showTeamName ? $game->home : "")}}
                                            </div>
                                        </div>
                                        <div class="pull-right width50 padding-10">
                                            <img src="/img/team_logos/{{$game->away_logo}}" height="60" width="65" alt="{{$game->away}}">
                                            <div class="text-left middle {{$gameOver ? '' : $isNextWeekList ? 'width50' : 'width60'}} inline-flex">
                                                {{$gameOver ? $game->away_score : ($showTeamName ? $game->away : "")}}
                                            </div>
                                        </div>
                                    </a>
                                </td>
                                @if($showPlayGameBtn || $showPicksAvail)
                                    <td id="playGameBtn" style="padding: 0px;{{$showPicksAvail ? "padding-bottom:10px;" :""}} ">
                                        @if($showPlayGameBtn)
                                            <a href="{{action('GamesController@show', [$game->id])}}" class="btn playGameBtn" style="min-width:85%;">
                                                @if($gameOver)
                                                    @if($gameCancel)
                                                        CANCELLED
                                                    @else
                                                        SEE RESULTS
                                                    @endif
                                                @else
                                                    @if ($numberOfPicks < 100 && !$gameStarted)
                                                        {{(in_array("$game->id", $playingIn)) ? 'GO TO GAME' : 'JOIN GAME'}}
                                                    @elseif($gameCancel)
                                                        CANCELLED
                                                    @else
                                                        SEE GAME
                                                    @endif
                                                @endif
                                            </a>
                                        @endif
                                        @if ($showPicksAvail)
                                            @if(!$gameStarted && !$gameOver)
                                                <div class="absolute width25">
                                                    <div id="availablePicks">
                                                        <div id="availablePicksBar" style="width: {{($numberOfPicks<92)?(100-$numberOfPicks):(($numberOfPicks >= 92 && $numberOfPicks < 100)?8:100)}}%; background-color: <?= ($numberOfPicks <= 40) ? 'green' : (($numberOfPicks <= 65 && $numberOfPicks > 40) ? '#475613' : (($numberOfPicks <= 80 && $numberOfPicks > 65) ? '#923127' : 'crimson'))?>;"></div>
                                                    </div>
                                                    <div id="availablePicksLabel">
                                                        <small>
                                                            <i>
                                                                @if ($numberOfPicks == 100)
                                                                    Sorry, Game is Full
                                                                @elseif ($numberOfPicks >= 90 && $numberOfPicks < 100)
                                                                    Hurry, only {{100 - $numberOfPicks}} pick{{($numberOfPicks == 99) ? '' : 's'}} left!
                                                                @elseif ($numberOfPicks > 0 && $numberOfPicks < 100)
                                                                    {{100 - $numberOfPicks}} Picks Available
                                                                @else
                                                                    Be the first to pick!
                                                                @endif
                                                            </i>
                                                        </small>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="absolute width25">
                                                    <div id="availablePicks">
                                                        <div id="availablePicksBar" style="width: 100%; background-color: {{$gameOver ? '#181818' : ($gameCancel ? 'crimson' : '#2A68A4') }};"></div>
                                                    </div>
                                                    <div id="availablePicksLabel">
                                                        <small>
                                                            <i style="color: {{$gameOver ? 'grey' : '#fff'}};">
                                                                Game
                                                                @if($gameOver)
                                                                    Over
                                                                @elseif ($gameCancel)
                                                                    Cancelled
                                                                @else
                                                                    Started
                                                                @endif
                                                            </i>
                                                        </small>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endif
                @endforeach
            </tbody>
        </table>
@endforeach
