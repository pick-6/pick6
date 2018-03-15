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
    .dashboardSection .playGameBtn {
        width: 85%;
    }
    .dashboardSection>#no-more-tables {
        overflow: auto;
        height: calc(100% - 65px);
        width: 100%;
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
            padding-left: 5px!important;
        }
        .dashboardSection .playGameBtn {
            width: 100%;
        }
        .welcome.dashboard {
            padding: 10px;
        }
    }
</style>
<header class="welcome dashboard" style="overflow: auto;">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="dashboardSection">
                    <h3 class="fc-white text-center">Games for the Week</h3>
                    <div id="no-more-tables" class="container table-responsive">
                    @foreach ($dateOfGame as $date)
                        <h4 class="dateOfGame" style="clear: both;color: lightgrey;/*text-align: left;*/">
                            {{date("l, F dS", strtotime("$date->date_for_week"))}}
                        </h4>
                        <table class="col-md-12 table-bordered table-condensed fc" style="margin-bottom: 10px">
                            <colgroup>
                                <col style="width: 15%">
                                <col>
                                <col style="width: 25%">
                            </colgroup>
                            <tbody>
                            @foreach ($gamesForWeek as $game)
                            @if ($date->date_for_week == $game->date_for_week)
                                <tr>
                                    <td class="gameDayTime" data-title="Kick-Off">
                                        {{date("g:i", strtotime("$game->time"))}} pm
                                    </td>

                                    <td class="gameTeams" data-title="Game">
                                        <a href="{{action('GamesController@show', [$game->id])}}">
                                            {{$game->home}} vs. {{$game->away}}
                                        </a>
                                    </td>

                                    <td id="playGameBtn">
                                        <a href="{{action('GamesController@show', [$game->id])}}" class="btn playGameBtn">
                                            <?= (in_array("$game->id", $playingIn)) ? 'GO TO GAME' : 'JOIN GAME'; ?>
                                        </a>
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
                       <table class="table table-bordered" style="margin-bottom: 0px">
                            <colgroup>
                                <col>
                                <col style="width: 20%">
                            </colgroup>
                           <tbody>
                           @foreach ($myCurrentGames as $game)
                               <tr>
                                   <td data-title="Game" style="vertical-align: middle;">
                                       <a href="{{action('GamesController@show', [$game->game_id])}}">
                                        {{$game->home}} vs. <br/>{{$game->away}} 
                                       </a>
                                   </td>
                                   
                                    <td data-title="" style="vertical-align: middle;">
                                       <a href="{{action('GamesController@show', [$game->game_id])}}" class="btn">
                                            GO TO GAME
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <p style="font-size: 1.5em;width: 60%;margin:0 auto;color: lightgrey;margin-top: 50px">
                            You're not involved in any games yet.
                        </p>
                        <div id="startPlayingBtn">
                            <a href="/play" class="btn btn-xl startPlayingBtn">JOIN A GAME</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row" style="padding-top: 30px">
            <div class="col-md-4" style="padding-left:0px;">
                <div class="dashboardSection">
                    <h3>Last Week's Results</h3>
                    <div id="no-more-tables" class="container table-responsive">
                        <table class="table table-bordered" style="margin-bottom: 0px">
                            <thead>
                                <tr>
                                    <th>Game</th>
                                    <th class="text-center">Winner</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($lastWeekResults as $game)
                                <tr>
                                    <td data-title="Game" style="text-align: left;">
                                        {{$game->home}} vs {{$game->away}}
                                    </td>
                                    <td data-title="Winner" style="vertical-align: middle;">
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
            <div class="col-md-4" style="padding-right:0px;">
                <div class="dashboardSection">
                    <h3>Leaderboard</h3>
                    <div id="no-more-tables" class="container table-responsive">
                       <table class="table table-bordered" style="margin-bottom: 0px">
                            <colgroup>
                                <col style="width: 10%">
                                <col>
                                <col style="width: 20%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center">Rank</th>
                                    <th>Player Name</th>
                                    <th class="text-center">Wins</th>
                                </tr>
                            </thead>
                           <tbody>
                            @foreach ($leaderboard as $index => $player)
                                <tr class="<?= ($player->winning_user == Auth::user()->id) ? 'fc-yellow' : ''?>">
                                    <td data-title="Rank">
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
                                    <td data-title="Player Name" style="text-align: left;">
                                        <!-- <img src="/img/profilePics/{{$player->avatar}}" height="25" width="25"> -->
                                        {{$player->first_name}} {{$player->last_name}}
                                    </td>
                                    <td data-title="Wins">{{$player->wins}}</td>
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