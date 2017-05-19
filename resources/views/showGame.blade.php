@extends('layouts.master')
@section('content')

<section class="showGamePage">
    <div class="container">
        @if ($game->date_for_week > date('Y-m-d')) <!-- Show game table for future games -->

            <!-- Message user that their square selection has been saved successfully  -->
            @if (Session::has('successMessage'))
                <div class="alert alert-success text-center">{{ session('successMessage') }}</div>
            @endif
    
    
            <!-- PICK A SQUARE -->
            <div class="col-md-12 text-center">
                <h1 class="gameSteps">Step 2:</h1>
                <h3 class="gameSteps">Pick A Square From The Table Below</h3>
                <p>(Remember that the numbers represent the last digit of the final score for each team)</p>
            </div>
        
            
            <!-- HOME TEAM NAME -->
            <div class="col-md-12 homeTeamName">
                <h1 class="text-center">{{$game->home}}</h1>
                <p class="text-center homeTeamTop">(Top of the table)</p>
            </div>
        
            <!-- AWAY TEAM NAME FOR DESKTOP (shows on the left side of the table) -->
            <div class="col-md-2">  
                <h1 class="text-center awayTeamNameDesktop">{{$game->away}}</h1>
            </div>
        
            <!-- SQUARES GAME TABLE -->
            <div class="container col-md-8">
                <table class="table table-bordered">
                    <tr>
                        <th style="border-color: black"></th>
                        <!-- Creates numbers 0-9 going across -->
                        @for ($column = 0; $column < 10; $column++)
                            <th style="border-color: black">{{$column}}</th>
                        @endfor
                    </tr>
        
                    <!-- Creates numbers 0-9 going down -->
                    @for ($row = 0; $row < 10; $row++)
                        <tr>
                            <th style="border-color: black">{{$row}}</th>
                            <!-- Creates all 100 squares on the table -->
                            @for ($column = 0; $column < 10; $column++)
                                @if (in_array("$column$row", $thisGameSelections))
                                    <td style="background-color: #9b1b18"></td>
                                @else
                                    <td class="availableSquare" href="#pickSquare" data-hscore="{{$column}}" data-ascore="{{$row}}" data-toggle="modal"></td>
                                @endif
                            @endfor
                        </tr>
                    @endfor
                </table>
            </div>
    
            <!-- AWAY TEAM NAME FOR MOBILE, TABLET (shows below the table) -->
            <div class="col-md-2 awayTeamName">  
                <h1 class="text-center">{{$game->away}}</h1>
                <p class="text-center">(Left side of the table)</p>
            </div>
    
            <!-- GO TO PAYMENT OPTION -->
            <div class="text-center anotherGameBtn finishGameBtn">
                <a href="{{action('SelectionsController@show')}}" class="btn btn-xl dropdown-toggle gameBtn" type="button">Go To Payment</a>
            </div>
    
            <!-- OR -->
            <div class="text-center">
                <h2 style="color: white">OR</h2>
            </div>
    
            <!-- CHOOSE ANOTHER GAME OPTION -->
            <div class="text-center finishGameBtn">
                <a href="{{action('GamesController@index')}}" class="btn btn-xl dropdown-toggle gameBtn" type="button">Choose Another Game</a>
            </div>

        @else <!-- Show past game results -->
            <h1 class="text-center" style="color: white">Final Score</h1>

            <div class="col-md-6 text-center">
                <h2 style="color: white">{{$game->home}}: <span style="color: #FEC503">{{$game->home_score}}</span></h2>  
            </div>

            <div class="col-md-6 text-center">  
                <h2 style="color: white">{{$game->away}}: <span style="color: #FEC503">{{$game->away_score}}</span></h2>
            </div>

            <div class="text-center">
                @if (Auth::user()->id == $game->winning_user)
                    <a href="/gameResults" class="btn btn-xl dropdown-toggle gameBtn" type="button">You Won!</a>
                @else
                    @foreach ($winningSelection as $winningUser)
                        <h1 style="color: white">Winning User: <span style="color: #FEC503">{{$winningUser->first_name}} {{$winningUser->last_name}}</span></h1>
                    @endforeach
                    @foreach ($winningCharitySelection as $winningCharity)
                        @foreach ($gameTotalBets as $amount)
                            <h1 style="color: white">A total of <span style="color: #FEC503">${{$amount->winning_total}}</span> went to <span style="color: #FEC503">{{$winningCharity->name}}</span></h1>
                        @endforeach
                    @endforeach
                @endif
            </div>
        @endif
    </div>
</section>

    <!-- Picking A Square Modal -->
    <div id="pickSquare" class="modal fade pickSquareModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">Picking A Square</h4>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{ action('SelectionsController@store') }}"> 
                        {!! csrf_field() !!}
                            <input type=hidden name="user_id" value= "{{ Auth::user()->id }}">
                            <input type=hidden name="game_id" value="{{$game->id}}">
                            <input type=hidden name="hscore" value="" class="hscore">
                            <input type=hidden name="ascore" value="" class="ascore">
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls userPick">
                                <h4 class="text-center">Your Pick</h4>
                                <p class="text-center">{{$game->home}} final score at the end of the game will end with a <input type="button" name="hscore" class="hscore btn" value="" style="background-color: black;border-color: black;color: #FEC503"></p>
                                <p class="text-center">{{$game->away}} final score at the end of the game will end with a <input type="button" name="ascore" class="ascore btn" value="" style="background-color: black;border-color: black;color: #FEC503"></p>
                                <div class="donation-container">
                                    <h4 class="text-center">Choose Donation Amount:</h4>
                                    <p class="text-center">(Your credit card won't be charged until you 'Go To Payment')</p>
                                    <div class="items col-xs-4">
                                        <div class="info-block block-info clearfix">
                                            <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                <label class="btn btn-default active">
                                                    <div class="bizcontent">
                                                        <input type="radio" name="amount" autocomplete="off" value="6" checked>
                                                        <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                        <h5>$6</h5>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="items col-xs-4">
                                        <div class="info-block block-info clearfix">
                                            <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                <label class="btn btn-default">
                                                    <div class="bizcontent">
                                                        <input type="radio" name="amount" autocomplete="off" value="10">
                                                        <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                        <h5>$10</h5>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="items col-xs-4">
                                        <div class="info-block block-info clearfix">
                                            <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                <label class="btn btn-default">
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
                            <button class="btn btn-success pull-left" type="submit">Confirm Square</button>
                            <button type="submit" data-dismiss="modal" class="btn btn-default btn-danger">Cancel</button>
                        </div>
                    </form>
                </div><!-- modal-body -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->

@stop