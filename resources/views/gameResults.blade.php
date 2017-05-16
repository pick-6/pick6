@extends('layouts.master')
@section('content')
<section style="background-color: black">
    <div class="container text-center" style="color: white">
        <div>
            @if ($gameWinner)
                <h1><span style="color: #FEC503">Great pick {{ Auth::User()->username }}! You won!</span></h1>
                <span>
                    <iframe src="https://giphy.com/embed/aNr6TVq3IJEXu" width="480" height="270" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/gifs/touchdown-referee-arena-football-aNr6TVq3IJEXu">via GIPHY</a></p>
                </span>
                <h2>The total contributions for this game :  ${{ $totalProceeds }}  </h2>
                <div class="dropdown text-center">
                    <h2>Please select your charity!</h2>
                    <button class="btn btn-xl dropdown-toggle gameBtn" type="button" data-toggle="dropdown">Pick a Charity <span class="caret"></span></button>
                    <ul class="dropdown-menu scrollable-menu">
                        @foreach ($charities as $charity)
                            <li><a class="page-scroll gameSelection" data-id="" href="">{{$charity->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            @else
                <h2>Aw, man! You didn't win this one, but you should try again!</h2>
                <a href="{{action('GamesController@index')}}" class="btn btn-xl dropdown-toggle gameBtn" type="button">Play Again</a>
            @endif 
        </div>
    </div>  
</section>
@stop