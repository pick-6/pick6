@extends('layouts.master')
@section('content')

    <!-- Account Page Header -->
    <header class="welcome">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in" style="margin-bottom: 10px">Hello, <span>{{ $user->first_name }} {{ $user->last_name }}</span></div>
                <div class="intro-heading" style="margin-bottom: 0px">Welcome to your account page!</div>
                <div class="intro-paragraph box_textshadow">Start playing right away or give yourself a refresher on how to play. <p>Additionally, you can find your current account information, which you may update if you would like.</div>
                <div class="intro-heading" style="margin-bottom: 10px">
                    <a style="color: black" href="/play" class="btn btn-lg">Play Game</a>
                    <a style="color: black" href="/howtoplay" class="btn btn-lg">How To Play</a>
                </div>
            </div>
        </div>
    </header>

    <!-- User's Current Picks -->
    <section class="text-center">
        <h1 style="color: white">Current Picks</h1>
        <div class="container">
            <table class="table table-bordered">
                <tr>
                    <th>Game</th>
                    <th>Selection</th>
                    <th>Donation Amount</th>
                    <th>Result</th>
                </tr>
                @foreach (Auth::User()->selections as $selection)
                <tr>
                    <td>
                    {{$selection->game->home}} vs. {{$selection->game->away}} 
                    </td>
                    <td>{{$selection->square_selection}}</td>
                    <td>${{$selection->amount}}</td>
                    <td><a style="color: black" href="{{action('ResultsController@showGameWinner', [$selection->game->id, $selection->square_selection])}}" class="btn btn-lg">SEE RESULTS</a></td>
                </tr>
                @endforeach
            </table>
            

            <!-- OR -->
            <div class="text-center">
                <h2 style="color: white;margin-top: 5%">OR</h2>
            </div>

            <!-- SEE PAST GAME RESULTS -->
            <div class="dropdown text-center" style="margin-top: 5%">
                <button class="btn btn-xl dropdown-toggle gameBtn" type="button" data-toggle="dropdown">See Past Game Results <span class="caret"></span></button>
                <ul class="dropdown-menu scrollable-menu">
                    @foreach ($games as $game)
                        @if ($game->date_for_week < date('Y-m-d'))
                            <li><a class="page-scroll gameSelection" data-id="{{$game->id}}" href="{{action('GamesController@show', [$game->id])}}">Week {{$game->week}} - Game {{$game->id}}: {{$game->home}} vs. {{$game->away}}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <!-- User's Account Information -->
    <section  class="featCharities text-center accountInfo">
        <div class="container">
            <h1 class="text-center">Your Account Info</h1>
            <h3>Full Name: {{Auth::user()->first_name}} {{Auth::user()->last_name}}</h3>
            <h3>Username: {{Auth::user()->username}}</h3>
            <h3>Email: {{Auth::user()->email}}</h3>
            <a style="color: black" href="{{action('AccountController@edit')}}" class="btn btn-lg">EDIT INFO</a>
        </div>
    </section>
    
@stop