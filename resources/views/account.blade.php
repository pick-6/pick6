@extends('layouts.master')
@section('content')
<style type="text/css">
    .dashboard {
        height: 100vh;
    }
    .dashboard>.container {
        padding-top: 125px;
        /*padding-top: 90px;*/
    }
    .dashboard .col-md-7, .dashboard .col-md-5 {
        height: 345px;
        /*height: 295px;*/
    }
    .dashboard .col-md-7 {
        padding-left: 0px;
    }
    .dashboard .col-md-5 {
        padding-right: 0px;
    }
    .dashboard .col-md-4 {
        /*height: 250px;*/
        /*height: 300px;*/
        height: 325px;
        /*height: 200px;*/
    }
    .dashboardSection {
        border:1px solid #555;
        height: 100%;
        padding: 5px 10px;
        background-color: rgba(0, 0, 0, .75);
        opacity: 0.80
    }
    .dashboardSection>h3 {
        margin-top: 10px;
    }
    .dashboardSection h4 {
        margin: 0px;
    }
    .dashboardSection .dateOfGame {
        position: sticky;
        top: 0px;
        background-color: #000;
        z-index: 1;
        padding-bottom: 5px;
    }
    .dashboardSection .gamesForWeekTables:not(:last-child) {
        margin-bottom: 10px;
    }
    .dashboardSection .playGameBtn {
        width: 85%;
    }
    .dashboard .dashboardSection .table-header {
        position: sticky;
        top:0px;
        height: auto!important;
        margin-bottom: 0px;
    }
    .dashboardSection>#no-more-tables {
        overflow: auto;
        width: 100%;
    }
    .dashboardSection>#no-more-tables {
        height: calc(100% - 55px);
    }
    @media (min-width: 700px) {
        .col-md-4>.dashboardSection>#no-more-tables {
            height: calc(100% - 83px);
        }
    }
    .dashboard .startPlayingBtn {
        border:1px solid #000;
        font-size: 20px;
        padding: 15px 30px;
    }
    .dashboard #startPlayingBtn {
        margin-top: 40px;
        /*margin-top: 25px;*/
    }
    @media (max-width: 991px) {
        [class^="col-md-"] {
            width: 100%;
            float: unset !important;
            padding: 0px !important;
            margin-bottom: 20px;
        }
        .row {
            padding-top: 0px!important;
        }
    }
    @media(max-width: 700px){
        .dashboardSection #playGameBtn {
            padding: 5px!important;
        }
        .dashboardSection .playGameBtn {
            width: 100%;
        }
        .welcome.dashboard {
            padding: 10px;
        }
        .dashboardSection h4 {
            text-align: center;
        }
    }
    .dashboardSection a:hover {
        text-decoration: none;
    }
    .dashboardSection.lastWeekResults .scores {
        text-align:left;
        vertical-align: middle;
        display: inline-flex;
        min-width: 30px; 
    }
    .dashboardSection #availablePicks {
        width: 85%;
        margin: 0 auto;
        background-color: grey;
        border-radius: 10px;
    }
    .dashboardSection #availablePicksBar {
        height: 12px;
        margin-top: 3px;
        background-color: green;
        border-radius: 10px;
    }
    .dashboardSection #availablePicksLabel {
        font-size: 12px;
        position: absolute;
        margin: 0 auto;
        width: 100%;
        top: 0px;
    }
</style>
<header class="welcome dashboard overflow-auto">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="dashboardSection">
                    <h3 class="fc-white text-center">Games for the Week</h3>
                    <div id="no-more-tables" class="container table-responsive">
                    @foreach ($dateOfGame as $date)
                        <h4 class="dateOfGame text-left clear fc-grey">
                            {{date("l, F dS", strtotime("$date->date_for_week"))}}
                        </h4>
                        <table class="col-md-12 table-bordered table-condensed fc gamesForWeekTables">
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
                                        {{date("g:i", strtotime("$game->time"))}}pm
                                    </td>

                                    <td class="gameTeams text-left" data-title="Game">
                                        <a class="fs-16" href="{{action('GamesController@show', [$game->id])}}">
                                            <div class="pull-left width50">
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

                                    <td id="playGameBtn" style="padding: 0px">
                                        <a href="{{action('GamesController@show', [$game->id])}}" class="btn playGameBtn">
                                            @if ($game->picks < 100)
                                                <?= (in_array("$game->id", $playingIn)) ? 'GO TO GAME' : 'JOIN GAME'; ?>
                                            @else
                                                SEE GAME
                                            @endif
                                        </a>
                                        <div class="width25 absolute">
                                            <div id="availablePicks">
                                                <div id="availablePicksBar" style="width: {{$game->picks}}%; background-color: <?= ($game->picks <= 40) ? 'green' : (($game->picks <= 65 && $game->picks > 40) ? '#475613' : (($game->picks <= 80 && $game->picks > 65) ? '#923127' : 'crimson'))?>;"></div>
                                            </div>
                                            <div id="availablePicksLabel">
                                                <small>
                                                    <i>
                                                        @if ($game->picks == 100)
                                                            Sorry, Game is Full
                                                        @elseif ($game->picks >= 90 && $game->picks < 100)
                                                            Hurry, only {{100 - $game->picks}} pick<?= ($game->picks == 99) ? '' : 's'?> left!
                                                        @elseif ($game->picks > 0 && $game->picks < 100)
                                                            {{100 - $game->picks}} Picks Available
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
                </div>
            </div>
            <div class="col-md-5">
                <div class="dashboardSection">
                   <h3>My Current Games</h3>
                   @if ($hasCurrentGames)
                   <div id="no-more-tables" class="container table-responsive">
                       <table class="table table-bordered margin-bottom-0">
                            <colgroup>
                                <col>
                                <col style="width: 35%">
                            </colgroup>
                           <tbody>
                           @foreach ($myCurrentGames as $game)
                               <tr>
                                   <td data-title="" id="playGameBtn" class="middle text-center">
                                       <a href="{{action('GamesController@show', [$game->game_id])}}">
                                            <div class="pull-left width50 fs-12">
                                                <img src="img/team_logos/{{$game->home_logo}}" height="30" width="35" alt="{{$game->home}}">
                                                <div class="text-left middle width70 inline-flex">
                                                    {{$game->home}}
                                                </div>
                                            </div>
                                            <!-- <span style="/*padding: 0px 40px">vs.</span> -->
                                            <div class="pull-right width50 fs-12">
                                                <img src="img/team_logos/{{$game->away_logo}}" height="30" width="35" alt="{{$game->away}}">
                                                <div class="text-left middle width70 inline-flex">
                                                    {{$game->away}}
                                                </div>
                                            </div> 
                                       </a>
                                   </td>
                                   
                                    <td data-title="" id="playGameBtn" class="middle padding-0">
                                       <a href="{{action('GamesController@show', [$game->game_id])}}" class="btn playGameBtn">
                                            GO TO GAME
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <p class="width60 margin-0-auto fc-grey margin-top-50" style="font-size: 1.5em;">
                            You're not involved in any games yet.
                        </p>
                        <div id="startPlayingBtn">
                            <a href="/play" class="btn btn-xl startPlayingBtn">JOIN A GAME</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row padding-t-30">
            <div class="col-md-4 padding-l-0">
                <div class="dashboardSection lastWeekResults">
                    <h3>Last Week's Results</h3>
                    <div id="no-more-tables" class="container table-responsive table-header">
                        <table class="table table-bordered margin-bottom-0">
                            <colgroup>
                                <col>
                                <col style="width:100px">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th style="padding: 3px" class="text-center">Final Score</th>
                                    <th style="padding: 3px" class="text-center">Winner</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div id="no-more-tables" class="container table-responsive margin-bottom-0">
                        <table class="table table-bordered margin-bottom-0">
                            <colgroup>
                                <col>
                                <col style="width:100px">
                            </colgroup>
                            <tbody>
                            @foreach ($lastWeekResults as $game)
                                <tr>
                                    <td data-title="Final Score" class="fc-yellow middle fs-25">
                                        <div class="pull-left width50">
                                            <img src="img/team_logos/{{$game->home_logo}}" height="40" width="45" alt="{{$game->home}}">
                                            <div class="scores">
                                                {{$game->home_score}}
                                            </div>
                                        </div>
                                        <!-- <span style="/*padding: 0px 40px">vs.</span> -->
                                        <div class="pull-right width50">
                                            <img src="img/team_logos/{{$game->away_logo}}" height="40" width="45" alt="{{$game->away}}">
                                            <div class="scores">
                                                {{$game->away_score}}
                                            </div>
                                        </div>
                                    </td>
                                    <td data-title="Winner" class="middle">
                                        <img src="/img/profilePics/{{$game->avatar}}" height="40" width="40" alt="{{$game->username}}"><br>
                                        <small>{{$game->username}}</small>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboardSection">
                    
                </div>
            </div>
            <div class="col-md-4 padding-3-0">
                <div class="dashboardSection">
                    <h3>Leaderboard</h3>
                    <div id="no-more-tables" class="container table-responsive table-header">
                       <table class="table table-bordered margin-bottom-0">
                            <colgroup>
                                <col style="width: 55px">
                                <col>
                                <col style="width: 55px">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th style="padding: 3px" class="text-center">Rank</th>
                                    <th style="padding: 3px">Player Name</th>
                                    <th style="padding: 3px" class="text-center">Wins</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div id="no-more-tables" class="container table-responsive margin-bottom-0"s>
                       <table class="table table-bordered margin-bottom-0">
                            <colgroup>
                                <col style="width: 55px">
                                <col>
                                <col style="width: 55px">
                            </colgroup>
                           <tbody>
                            @foreach ($leaderboard as $index => $player)
                                <tr class="<?= ($player->winning_user == Auth::user()->id) ? 'fc-yellow' : ''?>">
                                    <td data-title="Rank" class="middle">
                                        @if ($index == 0)
                                            <img src="/img/gold.png" height="20" width="20" alt="First Place"> 
                                        @elseif ($index == 1)
                                            <img src="/img/silver.png" height="20" width="20" alt="Second Place">
                                        @elseif ($index == 2)
                                            <img src="/img/bronze.png" height="20" width="20" alt="Third Place">
                                        @else 
                                            {{$index+1}}.
                                        @endif
                                    </td>
                                    <td data-title="Player Name" class="text-left">
                                        <img src="/img/profilePics/{{$player->avatar}}" height="25" width="25" alt="{{$player->first_name}} {{$player->last_name}}">
                                        <div class="text-left middle inline-block">
                                            {{$player->first_name}} {{$player->last_name}}
                                        </div>
                                    </td>
                                    <td data-title="Wins" class="middle">{{$player->wins}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script src="/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
    if ($(document).width() > 991) {
        $(".dashboardSection").on("mouseover", function(){
            $(this).css({"opacity":"0.95", "background-color":"rgba(0, 0, 0, 1)", "transition" : "opacity .2s ease-in"});
            $("body").css("overflow", "hidden");
        });
        $(".dashboardSection").on("mouseout", function(){
            $(this).css({"opacity":"0.80", "background-color":"rgba(0, 0, 0, 0.75)", "transition": "opacity .2s ease-out"});
            $("body").css("overflow", "auto");
        });
    } else {
        // $(".dashboardSection").css({"opacity":"0.95", "background-color":"rgba(0, 0, 0, 1)"});
        $(".dashboardSection").css({"opacity":"0.80", "background-color":"rgba(0, 0, 0, 0.75)"});
    }
</script>
@stop