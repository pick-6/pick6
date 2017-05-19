@extends('layouts.master')
@section('content')
<section style="background-color: black">
    <div class="container text-center" style="color: white">
        <div>
            @if ($gameWinner)
                <h1><span style="color: #FEC503">Great pick {{ Auth::User()->username }}! You won!</span></h1>
                <span>
                    <img class="img-responsive center-block" src="/img/youWon.gif" border="0" alt="You Won!"/>
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
                <a href="{{action('GamesController@index')}}" class="btn btn-lg dropdown-toggle gameBtn" type="button">PLAY AGAIN</a>
                <a href="{{action('AccountController@index')}}" class="btn btn-lg dropdown-toggle gameBtn" type="button">BACK TO ACCOUNT</a>
            @endif 
        </div>
    </div>  
</section>
@stop