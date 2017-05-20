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
    <section class="text-center" style="padding-top: 4%; padding-bottom: 4%;font-family: 'Montserrat', sans-serif;">
        <h1 style="color: white">Current Picks</h1>
        <div id="no-more-tables" class="container table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Game</th>
                    <th>Selection</th>
                    <th>Donation Amount</th>
                    <th>Result</th>
                </tr>
                </thead>
                @foreach (Auth::User()->selections as $selection)
                <tr>
                    <td data-title="Game">
                    {{$selection->game->home}} vs. {{$selection->game->away}} 
                    </td>
                    <td data-title="Selection">{{$selection->square_selection}}</td>
                    <td data-title="Donation Amount">${{$selection->amount}}</td>
                    <td data-title="Result"><a style="color: #FEC503" href="{{action('ResultsController@showGameWinner', [$selection->game->id, $selection->square_selection])}}" class="btn">SEE RESULT</a></td>
                </tr>
                @endforeach
            </table>
        </div>
        

        <!-- SEE PAST GAME RESULTS -->
        <div class="dropdown text-center" style="padding-top: 2%">
            <button class="btn btn-xl dropdown-toggle gameBtn" type="button" data-toggle="dropdown">See Past Game Results <span class="caret"></span></button>
            <ul class="dropdown-menu scrollable-menu">
                @foreach ($games as $game)
                    @if ($game->date_for_week < date('Y-m-d'))
                        <li><a class="page-scroll gameSelection" data-id="{{$game->id}}" href="{{action('GamesController@show', [$game->id])}}">Week {{$game->week}} - Game {{$game->id}}: {{$game->home}} vs. {{$game->away}}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </section>

    <!-- User's Account Information -->
    <section class="featCharities text-center accountInfo" style="padding-top: 3%">
        <div class="container">
            <h1 class="text-center" style="padding-bottom: 3%">Your Account Info</h1>
            <h4>Full Name: {{Auth::user()->first_name}} {{Auth::user()->last_name}}</h4>
            <h4>Username: {{Auth::user()->username}}</h4>
            <h4>Email: {{Auth::user()->email}}</h4>
            <a style="color: black" href="{{action('AccountController@edit')}}" class="btn btn-lg">EDIT INFO</a>
        </div>
    </section>
    
@stop