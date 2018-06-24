@extends('layouts.master')
@section('content')
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
    <!-- <div class="container"> -->
        <!-- CHOOSE A GAME -->
        <h3 class="fc-white text-center">Games for the Week</h3>
        <!-- <h1 class="gameSteps text-center">Step 1:</h1>
        <h3 class="text-center" style="color: #fff">Choose A Game</h3> -->

        <div id="no-more-tables" class="container table-responsive">
            @foreach ($dates as $date)
                <!-- TO DO: -->
                @if ($date->week == $currentWeek)
                <h4 class="dateOfGame text-left clear fc-grey"><?=date("l, F j<\s\m\a\l\l><\s\up>S</\s\up></\s\m\a\l\l>", strtotime("$date->date_for_week"))?></h4>

                <table class="col-md-12 table-bordered table-condensed fc" style="">
                    <colgroup>
                        <col style="width: 10%">
                        <col style="width: 70%">
                        <col style="width: 20%">
                    </colgroup>
                    <tbody>
                        @foreach ($games as $game)
                            <!-- TO DO: -->
                            @if ($date->week == $currentWeek)
                                @if ($date->date_for_week == $game->date_for_week)
                                    <tr>
                                        <td class="gameDayTime" data-title="Kick-Off">
                                            {{date("g:i", strtotime("$game->time"))}}pm
                                        </td>

                                        <td class="gameTeams text-left" data-title="Game">
                                            <a class="fs-16" href="{{action('GamesController@show', [$game->id])}}">
                                                <div class="pull-left width50 homeTeam">
                                                    <img src="img/team_logos/{{$game->home_logo}}" height="60" width="65" alt="{{$game->home}}">
                                                    <div class="text-left middle width60 inline-flex">
                                                        {{$game->home}}
                                                    </div>
                                                </div>
                                                <!-- <span style="/*padding: 0px 40px">vs.</span> -->
                                                <div class="pull-right width50">
                                                    <img src="img/team_logos/{{$game->away_logo}}" height="60" width="65" alt="{{$game->away}}">
                                                    <div class="text-left middle width60 inline-flex">
                                                        {{$game->away}}
                                                    </div>
                                                </div>
                                            </a>
                                        </td>

                                        <td id="playGameBtn">
                                            <a href="{{action('GamesController@show', [$game->id])}}" class="btn playGameBtn">
                                                <?= (in_array("$game->id", $playingIn)) ? 'GO TO GAME' : 'JOIN GAME'; ?>
                                            </a>
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
    <!-- </div> -->
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
