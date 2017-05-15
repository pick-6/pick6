@extends('layouts.master')
@section('content')
<section style="background-color: black">
    <div class="container text-center" style="color: white">
        <div>
            @if ($gameWinner)
                <h1><span style="color: #FEC503">You won!</span></h1>
                <h2>Thanks for playing!</h2>
                <h2>Please select an organization to send the contributions to!</h2>
                <a href="/charities" class="btn btn-xl dropdown-toggle gameBtn" type="button">List of Charities</a>
            @else
                <h2>Aw, man! You didn't win this one, but you should try again!</h2>
                <a href="{{action('GamesController@index')}}" class="btn btn-xl dropdown-toggle gameBtn" type="button">Play Again</a>
            @endif 
        </div>
    </div>  
</section>
@stop