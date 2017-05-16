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
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <a style="color: black" href="/gameResults" class="btn btn-lg">SEE RESULTS</a>
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