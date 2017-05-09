@extends('layouts.master')
@section('content')
	<h1>Logging In</h1>

	<form method="POST" action="{{action('Auth\AuthController@postLogin')}}">
		{!!csrf_field()!!}
		<div class="form-group">
			<label>Email</label> 
			<input type="email" name="email" value="{{old('email')}}" placeholder="Email" class="form-control">
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" name="password" value="{{old('password')}}" placeholder="Password" class="form-control">
		</div>
		<div class="form-group">
    	    <input type="checkbox" name="remember"> Remember Me
    	</div>
    	<div class="form-group">
    	    <button type="submit" class="btn btn-success">Login</button>
    	    <a href="/register" class="btn btn-primary pull-right">Go to Sign Up</a>
    	</div>
	</form>
	
@stop