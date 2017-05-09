@extends('layouts.master')

@section('content')
<section style="background-color: black">
<h1 style="color: white" class="text-center">Sign Up</h1>
<div class="container">
<form method="POST" action="{{action('Auth\AuthController@postRegister')}}">
    {!! csrf_field() !!}

    <div class="form-group">
        <label>First Name</label>
        <input style="background-color: #333333; color: #FED136" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" class="form-control">
    </div>

    <div class="form-group">
        <label>Last Name</label>
        <input style="background-color: #333333; color: #FED136" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" class="form-control">
    </div>

    <div class="form-group">
        <label>Username</label>
        <input style="background-color: #333333; color: #FED136" type="text" name="username" value="{{ old('username') }}" placeholder="Username" class="form-control">
    </div>

    <div class="form-group">
        <label>Email</label>
        <input style="background-color: #333333; color: #FED136" type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control">
    </div>

    <div class="form-group">
        <label>Password</label>
        <input style="background-color: #333333; color: #FED136" type="password" name="password" placeholder="Password" class="form-control">
    </div>

    <div class="form-group">
        <label>Confirm Password</label>
        <input style="background-color: #333333; color: #FED136" type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Sign Up</button>
        <a href="/login" style="color: black" class="btn btn-primary pull-right">Go to Login</a>
    </div>
</form>
</div>
</section>	
@stop