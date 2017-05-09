@extends('layouts.master')

@section('content')
<h1>Signing Up</h1>
<form method="POST" action="{{action('Auth\AuthController@postRegister')}}">
    {!! csrf_field() !!}

    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="form-control">
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control">
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Password" class="form-control">
    </div>

    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Sign Up</button>
        <a href="/login" class="btn btn-primary pull-right">Go to Login</a>
    </div>
</form>
	
@stop