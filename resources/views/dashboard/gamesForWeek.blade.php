<?php
    use \App\Http\Controllers\GamesController;
    use Carbon\Carbon;
?>

<h3 class="fc-white">
    @if($isPreSeason)
        <span class="fc-yellow">Preseason</span> Games - Week {{$week}}
    @elseif ($isPostSeason)
        <!-- WILD CARD WEEKEND -->
        <!-- DIVISIONAL PLAYOFFS -->
        <!-- CONFERENCE CHAMPIONSHIPS -->
        <!-- PRO BOWL -->
        <!-- SUPER BOWL -->
    @else
        Games for Week {{$week}}
    @endif
</h3>

@if ($hasGamesForWeek)
    <div id="no-more-tables" class="table-responsive">
        @foreach ($datesOfCurrentWeekGames as $date)
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
                            $gameEnded = !is_null($game->home_score) || !is_null($game->away_score);
                        ?>
                        @if ($date->date_for_week == $game->date_for_week)
                            <tr>
                                @if($gameEnded)
                                    <td class="fs-18 fc-yellow" style="padding:5px;text-align:center;">
                                        FINAL
                                    </td>
                                @else
                                    <td class="gameDayTime" data-title="Kick-Off">
                                        <div class="gamePrice">{{ str_replace(".00","",money_format('$%i',$game->pick_cost)) }}</div>
                                        @if (is_null($game->time))
                                            TBD
                                        @else
                                            {{date("g:i", strtotime("$game->time"))}} <small>{{date("A", strtotime("$game->time"))}}</small>
                                        @endif
                                    </td>
                                @endif
                                <td class="gameTeams text-left" style="padding:10px;">
                                    <a class="{{$gameEnded ? 'fs-30' : 'fs-16'}}" href="{{action('GamesController@show', [$game->id])}}">
                                        <div class="pull-left width50 homeTeam">
                                            <img src="/img/team_logos/{{$game->home_logo}}" height="60" width="65" alt="{{$game->home}}">
                                            <div class="text-left middle {{$gameEnded ? '' : 'width60'}} inline-flex">
                                                {{$gameEnded ? $game->home_score : $game->home}}
                                            </div>
                                        </div>
                                        <div class="pull-right width50">
                                            <img src="/img/team_logos/{{$game->away_logo}}" height="60" width="65" alt="{{$game->away}}">
                                            <div class="text-left middle {{$gameEnded ? '' : 'width60'}} inline-flex">
                                                {{$gameEnded ? $game->away_score : $game->away}}
                                            </div>
                                        </div>
                                    </a>
                                </td>
                                <td id="playGameBtn" style="padding: 0px;padding-bottom:10px;">
                                    <?php
                                        $numberOfPicks = GamesController::numberOfPicksForGame($game->id);
                                        $gameCancel = $numberOfPicks <= 90 && $gameStarted;
                                    ?>
                                    <a href="{{action('GamesController@show', [$game->id])}}" class="btn playGameBtn">
                                        @if($gameEnded)
                                            SEE RESULTS
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
                                    @if(!$gameStarted && !$gameEnded)
                                        <div class="width25 absolute">
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
                                        <div class="width25 absolute">
                                            <div id="availablePicks">
                                                <div id="availablePicksBar" style="width: 100%; background-color: {{$gameEnded ? '#181818' : ($gameCancel ? 'crimson' : '#2A68A4') }};"></div>
                                            </div>
                                            <div id="availablePicksLabel">
                                                <small>
                                                    <i style="color: {{$gameEnded ? 'grey' : '#fff'}};">
                                                        Game
                                                        @if($gameEnded)
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
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
    <div class="time text-left margin-top-5">
        <small>* All times are in Eastern Time (ET)</small>
    </div>
@else
    <p class="noGames margin-0-auto fc-grey margin-top-50" style="font-size: 1.5em;">
        There are no games this week.
    </p>
@endif
