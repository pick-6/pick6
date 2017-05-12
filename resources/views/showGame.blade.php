@extends('layouts.master')
@section('content')

<section class="playGamePage">
    <div class="container">
    
        <!-- PICK A SQUARE -->
        <div class="col-md-12 text-center pickSquare" >
            <h1 class="gameSteps">Step 2:</h1>
            <h3>Pick A Square From The Table Below</h3>
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
                                <p>Team 1 score will end with <input type="button" name="hscore" class="hscore" value=""></p>
                                <p>Team 2 score will end with <input type="button" name="ascore" class="ascore" value=""></p>
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