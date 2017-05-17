@extends('layouts.master')
@section('content')
<section class="playGamePage">
    <div class="container">
        <!-- CHOOSE A GAME -->
        <div class="dropdown text-center">
            <h1 class="gameSteps">Step 1:</h1>
            <button class="btn btn-xl dropdown-toggle gameBtn" type="button" data-toggle="dropdown">Choose A Game <span class="caret"></span></button>
            <ul class="dropdown-menu scrollable-menu">
                @foreach ($games as $game)
                    @if ($game->date_for_week > date('Y-m-d'))
                        <li><a class="page-scroll gameSelection" data-id="{{$game->id}}" href="{{action('GamesController@show', [$game->id])}}">Week {{$game->week}} - Game {{$game->id}}: {{$game->home}} vs. {{$game->away}}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</section>
@stop