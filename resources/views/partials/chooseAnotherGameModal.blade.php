<?php
    use \App\Http\Controllers\AccountController;
?>

<style>
    #chooseAnotherGame .modal-dialog {
        width: 55%;
    }
    @media(max-width:1250px){
        #chooseAnotherGame .modal-dialog {
            width: 85%;
        }
    }
    @media(max-width:768px){
        #chooseAnotherGame .modal-dialog {
            width: 100%;
        }
    }
    #availablePicks {
        width: 85%;
        margin: 0 auto;
        background-color: grey;
        border-radius: 10px;
    }
    #availablePicksLabel {
        font-size: 12px;
        position: absolute;
        margin: 0 auto;
        width: 100%;
        top: 0px;
    }
    #availablePicksBar {
        height: 12px;
        margin-top: 3px;
        background-color: green;
        border-radius: 10px;
    }
    @media(max-width:700px){
        #availablePicks {
            width: 100%!important;
        }
        #availablePicksBar {
            height: 20px!important;
        }
        #availablePicksLabel {
            font-size: 16px !important;
            margin: 2px auto !important;
            top: 38px!important;
            text-align: center;
        }
        .absolute {
            position: unset !important;
        }
        .width20 {
            width: unset !important;
        }
        #playGameBtn {
            padding: 5px!important;
        }
    }
    .width20 {
        width: 20%;
    }
</style>
<!-- Choose Another Game Modal -->
<div id="chooseAnotherGame" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color:#222;">
            <div class="closeModal"><button type="button" class="close" data-dismiss="modal">&times;</button></div>
            <div class="modal-body">
                <style type="text/css">
                    .playGamePage {
                        height: 700px;
                        /*height: 100vh;*/
                        padding: 0px;
                        /*padding-top: 70px;*/
                        /*padding-top: 100px;*/
                    }
                    .playGamePage #no-more-tables {
                        overflow: auto;
                        height: calc(100% - 25px);
                        /*max-height: calc(100% - 200px);*/
                        /*max-height: calc(100% - 145px);*/
                        width: 100%;
                        margin:0 auto;
                        /*padding-top: 0px;*/
                        /*background-color: #000;*/
                    }

                    .playGamePage #no-more-tables tr:nth-child(odd) {
                        background-color: #333;
                    }

                    .playGamePage #no-more-tables .table-bordered {
                        background-color:transparent;!important;
                        width: 100%;
                        font-size: 1.5em;
                        margin-bottom: 20px;
                        text-align: center;
                    }
                    .playGamePage #no-more-tables .dateOfGame:not(:first-child) {
                        margin-top: 25px;
                    }
                    .playGamePage #no-more-tables .dateOfGame {
                        color: #bbb;
                    }
                    .playGamePage .playGameBtn {
                        width: 85%;
                        padding: 5px;
                    }
                    .playGamePage .gameDayTime {
                        font-size: 0.75em;
                    }
                    @media(max-width: 767px) and (min-width: 701px){
                        .playGamePage #no-more-tables table {
                            font-size: 16px!important;
                        }
                    }
                    @media(max-width: 700px){
                        .playGamePage {
                            /*height: 100%!important;*/
                        }
                        .playGamePage #no-more-tables .table-bordered {
                            border:none!important;
                        }
                        .playGamePage #no-more-tables .table-bordered tbody tr{
                            border-bottom:none!important;
                            margin-bottom: 15px;
                        }
                        .playGamePage #no-more-tables td {
                            padding-left: 40%;
                        }
                        .playGamePage .gameDayTime {
                            width: 100%!important;
                        }
                        .playGamePage .gameTeams {

                        }
                        .playGamePage .playGameBtn {
                            width: 100%!important;
                            text-align: center;
                        }
                        .playGamePage #playGameBtn {
                            padding-left: 8px!important;
                        }
                        .playGamePage [data-title="Game"] {
                            font-size: 0.75em;
                        }
                        .playGamePage #no-more-tables {
                            position: relative;
                        }
                        .playGamePage #no-more-tables .dateOfGame  {
                            background-color: #000;
                            text-align: center;
                        }
                        .gameTeams .pull-left, .gameTeams .pull-right {
                            float: none !important;
                        }
                        .gameTeams .homeTeam {
                            margin-bottom: 10px;
                        }
                        .gameTeams .width50 {
                            width: unset !important;
                        }
                    }
                    .playGamePage #no-more-tables {
                        position: relative;
                    }
                    .playGamePage #no-more-tables .dateOfGame  {
                        position: sticky;
                        /*top: -20px;*/
                        top: 0px;
                        z-index: 1;
                        background-color: #fed136;
                        color: #000!important;
                        border: 1px solid lightgrey;
                        /*background-color: #000;*/
                        /*text-align: center;*/
                        /*padding-bottom: 5px;*/
                        /*padding-top: 5px;*/
                        width: auto;
                        padding: 5px;
                        margin-bottom: 0px;
                    }
                    h4.dateOfGame small {
                        color: inherit!important;
                    }
                    @media (min-width: 700px) and (max-width: 1200px) {
                        td#playGameBtn {
                            padding: 0!important;
                        }
                    }
                    sup {
                        font-weight: bold;
                    }
                    @media(max-width: 1200px){
                        .container {
                            width: 95%;
                        }
                    }
                </style>
                <div class="playGamePage">
                    <h3 class="fc-white text-center">Games for the Week</h3>

                    <div id="no-more-tables" class="table-responsive">
                        @foreach ($dates as $date)
                        @if ($date->week == $currentWeek)
                        <h4 class="dateOfGame text-left clear fc-grey"><?=date("l, F j<\s\m\a\l\l><\s\up>S</\s\up></\s\m\a\l\l>", strtotime("$date->date_for_week"))?></h4>

                        <table class="col-sm-12 table-bordered table-condensed fc" style="">
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
                                                <div id="availablePicksBar" style="width: {{($numberOfPicks<92)?(100-$numberOfPicks):(($numberOfPicks >= 92 && $numberOfPicks < 100)?8:100)}}%; background-color: <?= ($numberOfPicks <= 40) ? 'green' : (($numberOfPicks <= 65 && $numberOfPicks > 40) ? '#475613' : (($numberOfPicks <= 80 && $numberOfPicks > 65) ? '#923127' : 'crimson'))?>;">

                                                </div>
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
