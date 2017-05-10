@extends('layouts.master')
@section('content')
<section style="background-color: black">
	<h1 class="text-center">Welcome, {{Auth::user()->first_name}}</h1>
	<div class="container text-center">
	    <a style="color: black" href="/play" class="btn btn-xl">Play Game</a>
	    <a style="color: black" href="/howtoplay" class="btn btn-xl">How To Play</a>
	</div>
</section>

<section style="background-color: black" class="text-center">
	<h1 class="text-center">Your Account Info</h1>
	<h3>Full Name: {{Auth::user()->first_name}} {{Auth::user()->last_name}}</h3>
	<h3>Username: {{Auth::user()->username}}</h3>
	<h3>Email: {{Auth::user()->email}}</h3>
</section>
@stop