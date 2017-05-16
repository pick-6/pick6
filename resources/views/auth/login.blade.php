@extends('layouts.master')
@section('content')
<section style="padding-bottom: 22%">
    <h1 style="color: white" class="text-center">Log In</h1>
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
    <form method="POST" action="{{action('Auth\AuthController@postLogin')}}">
        {!!csrf_field()!!}
        <div class="form-group">
            <label>Email</label> 
            <input type="email" name="email" value="{{old('email')}}" placeholder="Email" class="form-control loginSignupPage">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" value="{{old('password')}}" placeholder="Password" class="form-control loginSignupPage">
        </div>
        <div class="form-group">
            <input type="checkbox" name="remember" class="loginSignupPage"> Remember Me
        </div>
        <div class="form-group">
            <button type="submit" style="color: black;font-family: 'Montserrat', sans-serif;font-weight: bold;" class="btn btn-success">LOGIN</button>
            <a href="/register" style="color: black" class="btn btn-primary pull-right">Go to Sign Up</a>
        </div>
    </form>
    </div>
</section>
@stop