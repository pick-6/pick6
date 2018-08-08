<?php
use \App\Http\Controllers\GamesController;
use Carbon\Carbon;
?>

@extends('layouts.master')
@section('content')
<div class="playGamePage">
    <h3 class="fc-white text-center margin-top-0">Games for the Week</h3>
    <div id="no-more-tables" class="table-responsive">
        @foreach ($dates as $date)
            @if ($date->week == $currentWeek)
                <h4 class="dateOfGame text-left clear fc-grey"><?=date("l, F j<\s\m\a\l\l><\s\up>S</\s\up></\s\m\a\l\l>", strtotime("$date->date_for_week"))?></h4>
                <table class="col-sm-12 table-bordered table-condensed gamesForWeekTables">
                    <colgroup>
                        <col style="width: 10%">
                        <col>
                        <col style="width: 25%">
                    </colgroup>
                    <tbody>
                        @foreach ($games as $game)
                            <?php
                                $gameTime = $game->date_for_week . ' ' . $game->time;
                                $gameStarted = $gameTime <= Carbon::now('America/New_York');
                                $gameEnded = !is_null($game->home_score) || !is_null($game->away_score);
                            ?>
                            @if ($date->week == $currentWeek)
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
                                        <td class="gameTeams text-left padding-10">
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
                                            <a href="{{action('GamesController@show', [$game->id])}}" class="btn playGameBtn" style="min-width:85%;">
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
                                                        <div id="availablePicksBar" style="width: 100%; background-color: crimson;"></div>
                                                    </div>
                                                    <div id="availablePicksLabel">
                                                        <small>
                                                            <i>
                                                                Game {{$gameEnded ? "Over" : $gameCancel ? "Cancelled" : "Started"}}
                                                            </i>
                                                        </small>
                                                    </div>
                                                </div>
                                            @endif
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

<script src="/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
if ($(document).width() > 991) {
    $(".playGamePage #no-more-tables").on("mouseover", function(){
        $("body").css("overflow", "hidden");
    });
    $(".playGamePage #no-more-tables").on("mouseout", function(){
        $("body").css("overflow", "auto");
    });
}
</script>
@stop
