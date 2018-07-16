<?php
    use \App\Http\Controllers\GamesController;
?>

<h3 class="fc-white">Games for the Week</h3>

@if ($hasGamesForWeek)
    <div id="no-more-tables" class=" table-responsive">
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
                        @if ($date->date_for_week == $game->date_for_week)
                            <tr>
                                <td class="gameDayTime" data-title="Kick-Off">
                                    <div class="gamePrice">{{ str_replace(".00","",money_format('$%i',$game->pick_cost)) }}</div>
                                    {{date("g:ia", strtotime("$game->time"))}}
                                </td>

                                <td class="gameTeams text-left" style="padding:10px;">
                                    <a class="fs-16" href="{{action('GamesController@show', [$game->id])}}">
                                        <div class="pull-left width50 homeTeam">
                                            <img src="img/team_logos/{{$game->home_logo}}" height="60" width="65" alt="{{$game->home}}">
                                            <div class="text-left middle width60 inline-flex">
                                                {{$game->home}}
                                            </div>
                                        </div>
                                        <div class="pull-right width50">
                                            <img src="img/team_logos/{{$game->away_logo}}" height="60" width="65" alt="{{$game->away}}">
                                            <div class="text-left middle width60 inline-flex">
                                                {{$game->away}}
                                            </div>
                                        </div>
                                    </a>
                                </td>

                                <td id="playGameBtn" style="padding: 0px;padding-bottom:10px;">
                                    <?php
                                         $numberOfPicks = GamesController::numberOfPicksForGame($game->id);
                                    ?>
                                    <a href="{{action('GamesController@show', [$game->id])}}" class="btn playGameBtn">
                                        @if ($numberOfPicks < 100)
                                            {{(in_array("$game->id", $playingIn)) ? 'GO TO GAME' : 'JOIN GAME'}}
                                        @else
                                            SEE GAME
                                        @endif
                                    </a>
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
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
@else
    <p class="width60 margin-0-auto fc-grey margin-top-50" style="font-size: 1.5em;">
        There are no games this week.
    </p>
@endif
