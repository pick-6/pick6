@extends('layouts.master')
@section('content')

<section style="background-color: black">
<div class="container">

    <!-- CHOOSE A GAME -->
    <div class="dropdown text-center">
    <h1 style="color: white">Step 1:</h1>
        <button style="color: black;" class="btn btn-xl dropdown-toggle" type="button" data-toggle="dropdown">Choose A Game <span class="caret"></span></button>
        <ul class="dropdown-menu scrollable-menu" style="margin-left: 39%"> <!-- 12% for mobile -->
            <li><a href="#">Game 1: Cowboys vs. Redskins</a></li>
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
    <div class="col-md-12 text-center" style="margin-top: 5%">
    <h1 style="color: white">Step 2:</h1>
        <h3 style="color: white">Pick A Square From The Table Below</h3>
        <p style="color: white">(Remember that the numbers represent the last digit of the final score for each team)</p>
    </div>


    <!-- TEAM 1 NAME -->
    <div class="col-md-12" style="clear: both">
        <h1 class="text-center" style="color: white">Team 1</h1>
    </div>

    <!-- TEAM 2 NAME -->
    <div class="col-md-2">  
        <h1 class="text-center" style="color: white;float: left;transform: rotate(-90deg);transform-origin: right bottom 0;">Team 2</h1> 
        <!-- <h1 class="text-center" style="color: white">Team 2</h1> -->
    </div>


    <!-- SQUARES GAME TABLE -->
    <div class="table-responsive container col-md-10">
        <table class="table table-bordered" style="background-color: #333;color: white;">
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
                        <td style="border-color: black">{{$column}}{{$row}}</td>
                    @endfor
                </tr>
            @endfor
        </table>
    </div>

</div>
</section>
@stop