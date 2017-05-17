@extends('layouts.master')
@section('content')
<section>
	<div class="container">
		<h1 class="text-center" style="color: white;">Payment Page</h1>
		<div class="text-center">
        	<a href="{{action('AccountController@index')}}" class="btn btn-xl dropdown-toggle gameBtn" type="button">Submit Payment</a>
		</div>
	</div>
</section>
@stop