<?php
    use \App\Http\Controllers\AccountController;
?>

<!-- Choose Another Game Modal -->
<div id="chooseAnotherGame" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-center closeModalBtnContainer">
                <button type="button" class="close btn closeModalBtn" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="playGamePage">
                    <h3 class="fc-white text-center margin-top-0">Games for the Week</h3>
                    <div id="no-more-tables" class="table-responsive">
                        @foreach ($dates as $date)
                            @if ($date->week == $currentWeek)
                                <h4 class="dateOfGame text-left clear fc-grey"><?=date("l, F j<\s\m\a\l\l><\s\up>S</\s\up></\s\m\a\l\l>", strtotime("$date->date_for_week"))?></h4>
                                <table class="col-sm-12 table-bordered table-condensed gamesForWeekTables">
                                    <colgroup>
                                        <col style="width: 10%">
                                        <col style="width: 70%">
                                        <col style="width: 20%">
                                    </colgroup>
                                    <tbody>
                                        @foreach ($allGames as $game)
                                            @if ($date->week == $currentWeek)
                                                @if ($date->date_for_week == $game->date_for_week)
                                                    <tr>
                                                        <td class="gameDayTime" data-title="Kick-Off">
                                                            {{date("g:i", strtotime("$game->time"))}}pm
                                                        </td>

                                                        <td class="gameTeams text-left" data-title="Game">
                                                            <a class="fs-16" href="{{action('GamesController@show', [$game->id])}}">
                                                                <div class="pull-left width50 homeTeam">
                                                                    <img src="/img/team_logos/{{$game->home_logo}}" height="60" width="65" alt="{{$game->home}}">
                                                                    <div class="text-left middle width60 inline-flex">
                                                                        {{$game->home}}
                                                                    </div>
                                                                </div>
                                                                <div class="pull-right width50">
                                                                    <img src="/img/team_logos/{{$game->away_logo}}" height="60" width="65" alt="{{$game->away}}">
                                                                    <div class="text-left middle width60 inline-flex">
                                                                        {{$game->away}}
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>

                                                        <td id="playGameBtn" style="padding: 0px;padding-bottom:10px;">
                                                            <?php
                                                                 $numberOfPicks = AccountController::numberOfPicksForGame($game->id);
                                                            ?>
                                                            <a href="{{action('GamesController@show', [$game->id])}}" class="btn playGameBtn">
                                                                @if ($numberOfPicks < 100)
                                                                    {{(in_array("$game->id", $playingIn)) ? 'GO TO GAME' : 'JOIN GAME'}}
                                                                @else
                                                                    SEE GAME
                                                                @endif
                                                            </a>
                                                            <div class="absolute width20">
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
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div><!-- modal-body -->
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- end Choose Another Game modal -->
