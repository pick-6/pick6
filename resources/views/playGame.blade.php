@extends('layouts.master')
@section('content')

<section class="playGamePage">
<div class="container">

    <!-- CHOOSE A GAME -->
    <div class="dropdown text-center">
    <h1 class="gameSteps">Step 1:</h1>
        <button class="btn btn-xl dropdown-toggle gameBtn" type="button" data-toggle="dropdown">Choose A Game <span class="caret"></span></button>
        <ul class="dropdown-menu scrollable-menu">
            <li><a class="page-scroll" href="#page-scroll">Game 1: Cowboys vs. Redskins</a></li>
            <li><a href="#">Game 2: Eagles vs. Giants</a></li>
            <li><a href="#">Game 3: Jets vs. Patriots</a></li>
            <li><a href="#">Game 4: Cowboys vs. Redskins</a></li>
            <li><a href="#">Game 5: Eagles vs. Giants</a></li>
            <li><a href="#">Game 6: Jets vs. Patriots</a></li>
            <li><a href="#">Game 7: Cowboys vs. Redskins</a></li>
            <li><a href="#">Game 8: Eagles vs. Giants</a></li>
            <li><a href="#">Game 9: Jets vs. Patriots</a></li>
            <li><a href="#">Game 10: Cowboys vs. Redskins</a></li>
            <li><a href="#">Game 11: Eagles vs. Giants</a></li>
            <li><a href="#">Game 12: Jets vs. Patriots</a></li>
            <li><a href="#">Game 13: Cowboys vs. Redskins</a></li>
            <li><a href="#">Game 14: Eagles vs. Giants</a></li>
            <li><a href="#">Game 15: Jets vs. Patriots</a></li>
            <li><a href="#">Game 16: Jets vs. Patriots</a></li>
        </ul>
    </div>


    <!-- PICK A SQUARE -->
    <div class="col-md-12 text-center pickSquare" id="page-scroll">
    <h1 class="gameSteps">Step 2:</h1>
        <h3>Pick A Square From The Table Below</h3>
        <p>(Remember that the numbers represent the last digit of the final score for each team)</p>
    </div>


    <!-- TEAM 1 NAME -->
    <div class="col-md-12 homeTeamName">
        <h1 class="text-center">Team 1</h1>
    </div>

    <!-- TEAM 2 NAME -->
    <div class="col-md-2">  
        <h1 class="text-center awayTeamName">Team 2</h1> 
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


    <!-- Picking A Square Modal -->    <!-- (confirm button not working yet) -->
    <div id="pickSquare" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Picking A Square</h4>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="">
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls userPick">
                                <h4>Your Pick</h4>
                                <p>Team 1 score will end with <input type="button" id="hscore" value=""></p>
                                <p>Team 2 score will end with <input type="button" id="ascore" value=""></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type=hidden name="id" value= "{{ Auth::user()->id }}">
                            <!-- CONFIRM SQUARE BUTTON-->
                            <form  method="POST" action="">
                                {!! csrf_field() !!}
                                <input class="btn btn-success pull-left" type="submit" value="Confirm Square">
                            </form>
                            <button type="submit" data-dismiss="modal" class="btn btn-default btn-danger">Cancel</button>
                        </div>
                    </form>
                </div><!-- modal-body -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->


</div>
</section>
@stop