<?php
    $currentWeek = 2;
?>
@extends('layouts.master')
@section('content')
<style>
    td:not(.notAvailable):hover{
        cursor: pointer;
    }
    .awayTeamNameDesktop {
        margin: 0px!important;
        width: 375px!important;
        left: -40px!important;
        position: absolute!important;
        top: 180px!important;
        display: block;
        color: white;
        /*text-align: left;*/
        transform: rotate(-90deg);
        transform-origin: center;
        /*margin-top: 40%*/
    }
</style>
<section class="showGamePage" style="padding: 0px;padding-top: 70px;height: 100vh">
    <div class="container">
        @if ($thisGame->week >= $currentWeek) <!-- Show game table for future games -->

            <!-- PICK A SQUARE -->
            <div class="col-md-12 text-center">
                <!-- <h1 class="gameSteps">Step 2:</h1>
                <h3 class="gameSteps">Pick A Square From The Table Below</h3> -->
                <h3 class="fc-white">Pick Your Square(s) From The Table Below</h3>
                <!-- <p>(Remember that the numbers represent the last digit of the final score for each team)</p> -->
            </div>


            <!-- HOME TEAM NAME -->
            <div class="col-md-12 homeTeamName" style="margin-top: 0px">
                <h1 class="text-center">{{$thisGame->home}}</h1>
                <p class="text-center homeTeamTop">(Top of the table)</p>
            </div>

            <!-- AWAY TEAM NAME FOR DESKTOP (shows on the left side of the table) -->
            <div class="col-md-2">
                <h1 class="text-center awayTeamNameDesktop">{{$thisGame->away}}</h1>
            </div>

            <!-- SQUARES GAME TABLE -->
            <div class="container col-md-8">
                <table class="table table-bordered" style="margin-bottom: 0px">
                    <tr>
                        <th style="border-color: black;background: linear-gradient(#ffce7a,#FEC503)"></th>
                        <!-- Creates numbers 0-9 going across -->
                        @for ($column = 0; $column < 10; $column++)
                            <th style="border-color: black;text-align: center;background: linear-gradient(#ffce7a,#FEC503)">?<!-- {{$column}} --></th>
                        @endfor
                    </tr>

                    <!-- Creates numbers 0-9 going down -->
                    @for ($row = 0; $row < 10; $row++)
                        <tr>
                            <th style="border-color: black;text-align: center;background: linear-gradient(#ffce7a,#FEC503)">?<!-- {{$row}} --></th>
                            <!-- Creates all 100 squares on the table -->
                            @for ($column = 0; $column < 10; $column++)
                                @if (in_array("$column$row", $thisGameSelections))
                                    @foreach($squaresSelected as $user)
                                        @if($user->square_selection == $column.$row)
                                            <td class="notAvailable" data-id="{{$column}}{{$row}}" style="background-image: url('/img/profilePics/{{$user->avatar}}');background-size: cover;"></td>
                                        @endif
                                    @endforeach
                                @else
                                    <td class="availableSquare" href="#pickSquare" data-id="{{$column}}{{$row}}" data-hscore="{{$column}}" data-ascore="{{$row}}" data-toggle="modal"></td>
                                @endif
                            @endfor
                        </tr>
                    @endfor
                </table>
            </div>

            <!-- AWAY TEAM NAME FOR MOBILE, TABLET (shows below the table) -->
            <div class="col-md-2 awayTeamName">
                <h1 class="text-center">{{$thisGame->away}}</h1>
                <p class="text-center">(Left side of the table)</p>
            </div>

            <!-- CHOOSE ANOTHER GAME -->
            <div class="dropdown text-center" style="padding-top: 45px;clear: both;/*width: 40%;margin: 0 auto*/">
                <button style="color: #000; text-transform: uppercase;" class="btn btn-lg dropdown-toggle gameBtn" type="button" data-toggle="dropdown">Choose Another Game <span class="fa fa-caret-up"></span></button>
                <ul class="dropdown-menu scrollable-menu" style="top:-95%;/*width: auto; margin: 0*/">
                    @foreach ($allGames as $otherGame)
                        @if ($otherGame->week == $currentWeek)
                            <li><a class="page-scroll gameSelection text-center" data-id="{{$otherGame->id}}" href="{{action('GamesController@show', [$otherGame->id])}}" style="font-size: 18px;"><img class="pull-left" src="http://localhost:8000/img/team_logos/{{$otherGame->home_logo}}" height="40" width="45" alt="{{$otherGame->home}}"> vs. <img class="pull-right" src="http://localhost:8000/img/team_logos/{{$otherGame->away_logo}}" height="40" width="45" alt="{{$otherGame->away}}"></a></li>
                        @endif
                    @endforeach
                </ul>
            </div>

        @else <!-- Show past game results -->
            @include('partials.pastGameResults')
        @endif
    </div>
</section>

@include('modals.pickSquareModal')

@stop
