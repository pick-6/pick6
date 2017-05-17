@extends('layouts.master')
@section('content')
<section>
	<div class="container">
		<h1 class="text-center" style="color: white;">Payment Page</h1>

		<h2 class="text-center" style="color: white;">Your Picks</h2>
		    <table class="table table-bordered">
                <tr>
                    <th>Game</th>
                    <th>Selection</th>
                    <th>Donation Amount</th>
                </tr>
                @foreach ($gamesUserIsPlaying as $userSelection)
                <tr>
                    <td>{{$userSelection->game_id}}</td>
                    <td>{{$userSelection->square_selection}}</td>
                    <td>${{$userSelection->amount}}</td>
                </tr>
                @endforeach
            </table>
		<div class="text-center">
        	<a href="{{action('AccountController@index')}}" class="btn btn-xl dropdown-toggle gameBtn" type="button">Submit Payment</a>
		</div>
	</div>
</section>
@stop