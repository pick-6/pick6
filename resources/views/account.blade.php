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
                        @foreach ($dates as $date)
                            <!-- TO DO: -->
                            @if ($date->date_for_week < date('now') && $date->date_for_week > date("Y-d-m", strtotime("2016-09-10")))
                            <h4 class="dateOfGame" style="color: lightgrey;/*text-align: left;*/">{{date("l, F dS", strtotime("$date->date_for_week"))}}</h4>
                
                            <table class="col-md-12 table-bordered table-condensed fc" style="margin-bottom: 10px">
                                <colgroup>
                                    <col style="width: 10%">
                                    <col style="width: 70%">
                                    <col style="width: 20%">
                                </colgroup>
                                <tbody>
                                    @foreach ($games as $game)
                                        <!-- TO DO: -->
                                        @if ($game->date_for_week < date('now') && $game->date_for_week > date("Y-d-m", strtotime("2016-09-10")))
                                            @if ($date->date_for_week == $game->date_for_week)
                                                <tr>
                                                    <td class="gameDayTime" data-title="Kick-Off">
                                                        {{date("g:i", strtotime("$game->time"))}} pm
                                                    </td>
                            
                                                    <td class="gameTeams" data-title="Game">
                                                        <a href="{{action('GamesController@show', [$game->id])}}">{{$game->home}} vs. {{$game->away}} </a>
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
                </div>
            </div>
            <div class="col-md-5">
                <div class="dashboardSection" style="padding: 5px 10px 5px 25px">
                   <h3>My Current Games</h3>
                   @if ($count > 0)
                   <div id="no-more-tables" class="table-responsive">
                       <table class="table table-bordered" style="width:97%;font-size: 16px;margin-bottom: 0px">
                           <tbody>
                           @foreach ($gamesUserIsPlaying as $game)
                               <tr>
                                   <td data-title="Game" style="vertical-align: middle;">
                                       <a href="{{action('GamesController@show', [$game->game_id])}}">{{$game->game->home}} vs. <br/>{{$game->game->away}} </a>
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
                        <p style="font-size: 1.5em;width: 60%;margin:0 auto;color: lightgrey;margin-top: 50px">You're not involved in any games yet.</p>
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
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Game</th>
                                    <th class="text-center">Winner</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($games as $game)
                                    <!-- TO DO: -->
                                    @if ($game->date_for_week < date('now') && $game->date_for_week <= date("Y-d-m", strtotime("2016-09-10")))
                                        <tr>
                                            <td data-title="Game" style="text-align: left;">{{$game->home}} vs {{$game->away}}</td>
                                            <td data-title="Winner" style="vertical-align: middle;">{{$game->winning_user}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

            <!--    <div id="no-more-tables" class="container table-responsive">
                        <table class="table table-bordered" style="font-size: 16px;font-family: 'Montserrat';margin-bottom: 0px">
                            <thead>
                                <tr>
                                    <th class="text-center">Game</th>
                                    <th class="text-center">Selection</th>
                                    <th class="text-center">Donation Amount</th>
                                    <th class="text-center">Result</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach (Auth::User()->selections as $selection)
                                <tr>
                                    <td data-title="Game" style="vertical-align: middle;">
                                        {{$selection->game->home}} vs. <br/>{{$selection->game->away}} 
                                    </td>
                                    <td data-title="Selection" style="vertical-align: middle;">{{$selection->square_selection}}</td>
                                    <td data-title="Donation Amount" style="vertical-align: middle;">${{$selection->amount}}</td>
                                    <td data-title="Result" style="vertical-align: middle;">
                                        <a href="{{action('ResultsController@showGameWinner', [$selection->game->id, $selection->square_selection])}}" class="btn">
                                            SEE RESULT
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div> -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboardSection">
                    
                </div>
            </div>
            <div class="col-md-4" style="padding-right:0px;">
                <div class="dashboardSection">
                    <h3>Leaderboard</h3>
                    <div id="no-more-tables" class="table-responsive">
                       <table class="table table-bordered">
                            <colgroup>
                                <col>
                                <col style="width: 25%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>Player Name</th>
                                    <th class="text-center"># of wins</th>
                                </tr>
                            </thead>
                           <tbody>
                            @foreach ($games as $key => $game)
                            <tr>
                                    <td data-title="Player Name" style="text-align: left;">
                                    @if ($key == 0)
                                        <img src="/img/gold.png" height="20" width="20"> 
                                    @elseif ($key == 1)
                                        <img src="/img/silver.png" height="20" width="20">
                                    @elseif ($key == 2)
                                        <img src="/img/bronze.png" height="20" width="20">
                                    @endif
                                        <!-- <img src="/img/<?php echo ($key == 0) ? "gold" : (($key == 1) ? "silver" : (($key == 2) ? "bronze" : ""))?>.png" height="20" width="20"> -->
                                    </td>
                                    <td data-title="# of wins"></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div id="startPlayingBtn">
            <a href="/play" class="btn btn-xl startPlayingBtn">START PLAYING</a>
        </div> -->
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





























    <!-- New Account Page -->
<!--     <header class="welcome" style="height: 100vh">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in" style="margin-bottom: 10px">
                    Hello, <span>{{ $user->first_name }} {{ $user->last_name }}</span>
                </div>
                <div class="intro-heading" style="margin-bottom: 0px">
                    Welcome to your account page!
                </div>
                <div class="intro-paragraph box_textshadow">
                    Start playing right away or give yourself a refresher on how to play.
                </div>
                <div class="intro-heading" style="margin-bottom: 10px">
                    <a style="color: black" href="/play" class="btn btn-lg">Play Game</a>
                    <a style="color: black" href="/howtoplay" class="btn btn-lg">How To Play</a>
                </div>
                <h1 style="color: white">Your Current Picks</h1>
                <div id="no-more-tables" class="container table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Game</th>
                            <th>Selection</th>
                            <th>Donation Amount</th>
                            <th>Result</th>
                        </tr>
                        </thead>
                        @foreach (Auth::User()->selections as $selection)
                            <tr>
                                <td data-title="Game">
                                    {{$selection->game->home}} vs. {{$selection->game->away}} 
                                </td>
                                <td data-title="Selection">{{$selection->square_selection}}</td>
                                <td data-title="Donation Amount">${{$selection->amount}}</td>
                                <td data-title="Result">
                                    <a style="color: #FEC503" href="{{action('ResultsController@showGameWinner', [$selection->game->id, $selection->square_selection])}}" class="btn">
                                        SEE RESULT
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="dropdown text-center" style="padding-top: 2%">
                    <button class="btn btn-xl dropdown-toggle gameBtn" type="button" data-toggle="dropdown">
                        See Past Game Results <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu scrollable-menu">
                        @foreach ($games as $game)
                            @if ($game->date_for_week < date('Y-m-d'))
                                <li>
                                    <a class="page-scroll gameSelection" data-id="{{$game->id}}" href="{{action('GamesController@show', [$game->id])}}">
                                        Week {{$game->week}} - Game {{$game->id}}: {{$game->home}} vs. {{$game->away}}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </header> -->


























    <!-- Account Page Header -->
    <!-- <header class="welcome" style="height: 100vh">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in" style="margin-bottom: 10px">Hello, <span>{{ $user->first_name }} {{ $user->last_name }}</span></div>
                <div class="intro-heading" style="margin-bottom: 0px">Welcome to your account page!</div>
                <div class="intro-paragraph box_textshadow">Start playing right away or give yourself a refresher on how to play. <p>Additionally, you can find your current account information, which you may update if you would like.</div>
                <div class="intro-heading" style="margin-bottom: 10px">
                    <a style="color: black" href="/play" class="btn btn-lg">Play Game</a>
                    <a style="color: black" href="/howtoplay" class="btn btn-lg">How To Play</a>
                </div>
            </div>
        </div>
    </header> -->

    <!-- User's Current Picks -->
    <!-- <section class="text-center" style="height: calc(100vh - 234px);padding-top: 4%; padding-bottom: 4%;font-family: 'Montserrat', sans-serif;">
        <h1 style="color: white">Current Picks</h1>
        <div id="no-more-tables" class="container table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Game</th>
                    <th>Selection</th>
                    <th>Donation Amount</th>
                    <th>Result</th>
                </tr>
                </thead>
                @foreach (Auth::User()->selections as $selection)
                <tr>
                    <td data-title="Game">
                    {{$selection->game->home}} vs. {{$selection->game->away}} 
                    </td>
                    <td data-title="Selection">{{$selection->square_selection}}</td>
                    <td data-title="Donation Amount">${{$selection->amount}}</td>
                    <td data-title="Result"><a style="color: #FEC503" href="{{action('ResultsController@showGameWinner', [$selection->game->id, $selection->square_selection])}}" class="btn">SEE RESULT</a></td>
                </tr>
                @endforeach
            </table>
        </div> -->
        

        <!-- SEE PAST GAME RESULTS -->
        <!-- <div class="dropdown text-center" style="padding-top: 2%">
            <button class="btn btn-xl dropdown-toggle gameBtn" type="button" data-toggle="dropdown">See Past Game Results <span class="caret"></span></button>
            <ul class="dropdown-menu scrollable-menu">
                @foreach ($games as $game)
                    @if ($game->date_for_week < date('Y-m-d'))
                        <li><a class="page-scroll gameSelection" data-id="{{$game->id}}" href="{{action('GamesController@show', [$game->id])}}">Week {{$game->week}} - Game {{$game->id}}: {{$game->home}} vs. {{$game->away}}</a></li>
                    @endif
                @endforeach
            </ul>
        </div> -->
    <!-- </section> -->
    
@stop