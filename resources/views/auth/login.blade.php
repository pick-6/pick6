@extends('layouts.master')
@section('content')
<section style="background-color: black;padding-bottom: 22%">
	<h1 style="color: white" class="text-center">Log In</h1>
<div class="container">
	<form method="POST" action="{{action('Auth\AuthController@postLogin')}}">
		{!!csrf_field()!!}
		<div class="form-group">
			<label>Email</label> 
			<input style="background-color: #333333; color: #FED136" type="email" name="email" value="{{old('email')}}" placeholder="Email" class="form-control">
		</div>
		<div class="form-group">
			<label>Password</label>
			<input style="background-color: #333333; color: #FED136" type="password" name="password" value="{{old('password')}}" placeholder="Password" class="form-control">
		</div>
		<div class="form-group">
    	    <input style="background-color: #333333; color: #FED136" type="checkbox" name="remember"> Remember Me
    	</div>
    	<div class="form-group">
    	    <button type="submit" class="btn btn-success">Login</button>
    	    <a href="/register" style="color: black" class="btn btn-primary pull-right">Go to Sign Up</a>
    	</div>
	</form>
	</div>
</section>
@stop