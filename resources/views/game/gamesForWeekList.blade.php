<?php
use \App\Http\Controllers\GamesController;
use \App\Http\Controllers\SelectionsController;
use Carbon\Carbon;
?>
<div id="no-more-tables" class="table-responsive">
    @foreach ($datesOfCurrentWeekGames as $date)
        @if ($date->week == $currentWeek)
            <h4 class="dateOfGame text-left clear fc-grey">
                <?=date("l, F j<\s\m\a\l\l><\s\up>S</\s\up></\s\m\a\l\l>", strtotime("$date->date_for_week"))?>
            </h4>
            <table class="col-sm-12 table-bordered table-condensed gamesForWeekTables">
                <colgroup>
                    <col style="width: 10%">
                    <col>
                    <col style="width: 25%">
                </colgroup>
                <tbody>
                    @foreach ($gamesForWeek as $game)
                        <?php
                            $gameTime = $game->date_for_week . ' ' . $game->time;
                            $gameStarted = $gameTime <= Carbon::now('America/New_York');
                            $gameOver = !is_null($game->home_score) || !is_null($game->away_score);
                        ?>
                        @if ($date->week == $currentWeek)
                            @if ($date->date_for_week == $game->date_for_week)
                                <tr>
                                    @if($gameOver)
                                        <td class="gameDayTime fc-yellow" style="padding:5px;text-align:center;">
                                            @if($showGameId)
                                                <div class="gameId">
                                                    <div class="gameId-ribbon-wrapper">
                                                        <div class="gameId-ribbon"><small class="fc-red">Id: {{$game->id}}</small></div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="gameTime fs-18">
                                                FINAL
                                            </div>
                                        </td>
                                    @else
                                        <td class="gameDayTime" data-title="Kick-Off">
                                            <div class="gamePrice">{{ str_replace(".00","",money_format('$%i',$game->pick_cost)) }}</div>
                                            @if (is_null($game->time))
                                                TBD
                                            @else
                                                {{date("g:i", strtotime("$game->time"))}} <small>{{date("A", strtotime("$game->time"))}}</small>
                                            @endif
                                            @if(Auth::user()->email == 'mattvaldez01@gmail.com')
                                                <div class="gamePrice margin-bottom-0 margin-top-5">
                                                    <small class="fc-red">Id: {{$game->id}}</small>
                                                </div>
                                            @endif
                                        </td>
                                    @endif
                                    <td class="gameTeams text-left padding-10">
                                        <a class="{{$gameOver ? 'fs-30' : 'fs-16'}} {{$gameCancel ? 'forGameCancel' : '' }}" data-role-ajax="<?= $gameCancel ? '/cancel/'.$game->id.'' : action('GamesController@show', [$game->id]) ?>">
                                            <div class="pull-left width50 homeTeam">
                                                <img src="/img/team_logos/{{$game->home_logo}}" height="60" width="65" alt="{{$game->home}}">
                                                <div class="text-left middle inline-flex" style="width:calc(100% - {{$gameOver ? 68 : 65}}px);">
                                                    {{$gameOver ? $game->home_score : $game->home}}
                                                </div>
                                            </div>
                                            <div class="pull-right width50">
                                                <img src="/img/team_logos/{{$game->away_logo}}" height="60" width="65" alt="{{$game->away}}">
                                                <div class="text-left middle inline-flex" style="width:calc(100% - {{$gameOver ? 68 : 65}}px);">
                                                    {{$gameOver ? $game->away_score : $game->away}}
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    @if($showPlayGameBtn || $showPicksAvail)
                                        <td id="playGameBtn" style="padding: 0px;{{$showPicksAvail ? "padding-bottom:10px;" :""}} ">
                                            @if($showPlayGameBtn)
                                                <a data-role-ajax="<?= $gameCancel ? '/cancel/'.$game->id.'' : action('GamesController@show', [$game->id]) ?>" class="btn playGameBtn {{$gameCancel ? 'forGameCancel' : '' }}" style="min-width:85%;">
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
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endif
    @endforeach
</div>
