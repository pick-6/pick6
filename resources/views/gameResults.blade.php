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
                            <li><a class="page-scroll gameSelection" data-id="" href="{{action('AccountController@index')}}">{{$charity->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            @else
            <div class="container">
                <div>
                    <h1>Aw, man! This pick wasn't a winner</h1>
                    <img class="img-responsive center-block" src="/img/crying.gif">
                </div>
                <div>
                    <h1>but thank you for your donation!</h1>
                </div>
                <div class="text-center">
                    <a href="{{action('AccountController@index')}}" class="btn btn-lg dropdown-toggle gameBtn" type="button">CHECK MY OTHER SQUARES</a> 
                </div>
                <a href="{{action('GamesController@index')}}" style="margin-top: 5%" class="btn btn-lg dropdown-toggle gameBtn" type="button">PLAY AGAIN</a>
            </div>
            @endif 
        </div>
    </div>  
</section>
@stop