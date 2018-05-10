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
                                    @foreach($squaresSelected as $test)
                                        @if($test->square_selection == $column.$row)
                                            <td class="notAvailable" data-id="{{$column}}{{$row}}" style="background-image: url('/img/profilePics/{{$test->avatar}}');background-size: cover;"></td>
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
            <h1 class="text-center" style="color: white">Final Score</h1>

            <div class="col-md-6 text-center">
                <h2 style="color: white">{{$thisGame->home}}: <br><span style="color: #FEC503">{{$thisGame->home_score}}</span></h2>
            </div>

            <div class="col-md-6 text-center">
                <h2 style="color: white">{{$thisGame->away}}: <br><span style="color: #FEC503">{{$thisGame->away_score}}</span></h2>
            </div>

            <div class="text-center">
                @if (Auth::user()->id == $thisGame->winning_user)
                    <a href="/gameResults" class="btn btn-xl dropdown-toggle gameBtn" type="button">You Won!</a>
                @else
                    @foreach ($winningSelection as $winningUser)
                        <h2 style="color: white">Winning User:<br> <span style="color: #FEC503">{{$winningUser->first_name}} {{$winningUser->last_name}}</span></h2>
                    @endforeach
                    @foreach ($winningCharitySelection as $winningCharity)
                            <h2 style="color: white">A total of <span style="color: #FEC503">${{$thisGame->winning_total}}</span> went to <span style="color: #FEC503">{{$winningCharity->name}}</span></h2>
                    @endforeach
                @endif
            </div>
        @endif
    </div>
</section>

    <!-- Picking A Square Modal -->
    <div id="pickSquare" class="modal fade pickSquareModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="background: linear-gradient(#222,#333);">
                <div class="closeModal" style="padding: 5px"><button type="button" class="close" data-dismiss="modal">&times;</button></div>
                <div class="modal-header">
                    <h4 class="modal-title text-center" style="color: #FEC503">Confirming Your Square Selection</h4>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{ action('SelectionsController@store') }}">
                        {!! csrf_field() !!}
                            <input type=hidden name="user_id" value= "{{ Auth::user()->id }}">
                            <input type=hidden name="game_id" value="{{$thisGame->id}}">
                            <input type=hidden name="hscore" value="" class="hscore">
                            <input type=hidden name="ascore" value="" class="ascore">
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls userPick">
                                <h4 class="text-center" style="color: #FEC503">Here Is Your Pick:</h4>
                                <p class="text-center" style="color: #eee">{{$thisGame->home}} final score at the end of the game will end with a <span class="hscore" style="margin-left: 5px"></span></p>
                                <p class="text-center" style="color: #eee">{{$thisGame->away}} final score at the end of the game will end with a <span class="ascore" style="margin-left: 5px"></span></p>
                                <div class="donation-container">
                                    <h4 class="text-center" style="color: #FEC503">Choose Your Donation Amount:</h4>
                                    <p class="text-center" style="color: #eee">(Your credit card won't be charged until you 'Go To Payment')</p>
                                    <div class="items col-xs-4 text-center" style="padding-right: 0px">
                                        <div class="info-block block-info clearfix">
                                            <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                <label class="btn btn-default active" style="border-color: initial;box-shadow:4px 4px 15px 0 #000">
                                                    <div class="bizcontent">
                                                        <input type="radio" name="amount" autocomplete="off" value="6" checked>
                                                        <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                        <h5>$6</h5>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="items col-xs-4 text-center" style="padding-right: 0px">
                                        <div class="info-block block-info clearfix">
                                            <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                <label class="btn btn-default" style="border-color: initial;box-shadow:4px 4px 15px 0 #000">
                                                    <div class="bizcontent">
                                                        <input type="radio" name="amount" autocomplete="off" value="10">
                                                        <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                        <h5>$10</h5>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="items col-xs-4 text-center" style="padding-right: 0px">
                                        <div class="info-block block-info clearfix">
                                            <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                <label class="btn btn-default" style="border-color: initial;box-shadow:4px 4px 15px 0 #000">
                                                    <div class="bizcontent">
                                                        <input type="radio" name="amount" autocomplete="off" value="20">
                                                        <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                        <h5>$20</h5>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success pull-left" type="submit" style="background-color: #5cb85c;border-color: #4cae4c">Confirm Square</button>
                            <button type="submit" data-dismiss="modal" class="btn btn-default btn-danger" style="color: #000;background-color: #d9534f;border-color: #d43f3a;">Cancel</button>
                        </div>
                    </form>
                </div><!-- modal-body -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->

@stop
