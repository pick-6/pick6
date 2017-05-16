@extends('layouts.master')

@section('content')
<section>
<h1 style="color: white" class="text-center">Sign Up</h1>
<div class="container">

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{action('Auth\AuthController@postRegister')}}">
    {!! csrf_field() !!}

    <div class="form-group">
        <label>First Name</label>
        <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" class="form-control loginSignupPage">
    </div>

    <div class="form-group">
        <label>Last Name</label>
        <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" class="form-control loginSignupPage">
    </div>

    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" class="form-control loginSignupPage">
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control loginSignupPage">
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Password" class="form-control loginSignupPage">
    </div>

    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control loginSignupPage">
    </div>

    <div class="form-group">
        <button type="submit" style="color: black;font-family: 'Montserrat', sans-serif;font-weight: bold;" class="btn btn-success">SIGN UP</button>
        <a href="/login" style="color: black" class="btn btn-primary pull-right">Go to Login</a>
    </div>
</form>
</div>
</section>
@stop