@extends('layouts.master')
@section('content')

<section style="background-color: black">
    <div class="container" >

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
    
        
        <!-- TEAM 1 NAME -->
        <div class="col-md-12 homeTeamName">
            <h1 class="text-center">{{$game->home}}</h1>
        </div>
    
        <!-- TEAM 2 NAME -->
        <div class="col-md-2">  
            <h1 class="text-center awayTeamName">{{$game->away}}</h1>
            <!-- <h1 class="text-center" style="color: white">Team 2</h1> -->
        </div>
    
    
        <!-- SQUARES GAME TABLE -->
        <div class="table-responsive container col-md-8">
            <table class="table table-bordered">
                <tr>
                    <th style="border-color: black"></th>
                    @for ($column = 0; $column < 10; $column++)
                        <th style="border-color: black">{{$column}}</th>
                    @endfor
                </tr>
    
                @for ($row = 0; $row < 10; $row++)
                    <tr>
                        <th style="border-color: black">{{$row}}</th>
                        @for ($column = 0; $column < 10; $column++)
                            <td href="#pickSquare" data-hscore="{{$column}}" data-ascore="{{$row}}" data-toggle="modal"></td>
                        @endfor
                    </tr>
                @endfor
            </table>
        </div>

        <!-- CHOOSE ANOTHER GAME OPTION -->
        <div class="text-center">
            <a href="{{action('GamesController@index')}}" class="btn btn-xl dropdown-toggle gameBtn" type="button">Choose Another Game</a>
        </div>

    </div>
</section>

    <!-- Picking A Square Modal -->
    <div id="pickSquare" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Picking A Square</h4>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{ action('SelectionsController@store') }}"> 
                        {!! csrf_field() !!}
                            <input type=hidden name="user_id" value= "{{ Auth::user()->id }}">
                            <input type=hidden name="game_id" value="{{$game->id}}">
                            <input type=hidden name="amount" value= "6">
                            <input type=hidden name="hscore" value="" class="hscore">
                            <input type=hidden name="ascore" value="" class="ascore">
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls userPick">
                                <h4>Your Pick</h4>
                                <p>{{$game->home}} final score at the end of the game will end with a <input type="button" name="hscore" class="hscore" value=""></p>
                                <p>{{$game->away}} final score at the end of the game will end with a <input type="button" name="ascore" class="ascore" value=""></p>
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