@extends('layouts.master')
@section('content')
<style type="text/css">
    .newSignLogin#container {
        background-color: #2e2e2e;
        width: 40%;
        margin: auto;
        padding: 2em;
        border-radius: 8px;
        border: hidden;
        opacity: .98;
    }

    .newSignLogin #buttons {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .newSignLogin .signup,
    .newSignLogin .login {
        height: 3em;
        display: flex;
        align-items: center;
        justify-content: center;
        border: hidden;
        font-size: large;
        font-weight: bold;
        color: #fff;
        background-color: #fff4;
        outline: none!important;
    }

    .newSignLogin .signup {
        border-radius: 8px 0 0 8px;
    }

    .newSignLogin .login {
        border-radius: 0 8px 8px 0;
    }

    .newSignLogin .active {
        background-color: #fed136;
        color: #111;
    }

    .newSignLogin .button,
    .newSignLogin .forgot-link {
        cursor: pointer;
    }

    .newSignLogin .button:hover {
        background-color: #FEC503;
        color: #111;
    }

    .newSignLogin .message {
        grid-column: 1/3;
        align-self: center;
        text-align: center;
        margin: .75em auto;
    }

    .newSignLogin input.form-control {
        grid-column: 1/3;
        margin-bottom: 1.5em;
        font-size: 16px;
    }

    .newSignLogin .last-name {
        margin-left: 5px;
    }
    .newSignLogin .last-name,
    .newSignLogin .first-name {
        width:calc(50% - 5px);
        display: inline-block;
    }

    .newSignLogin .forgot-pass {
        grid-column: 1/3;
        text-align: right;
        font-size: 0.8em;
        position: relative;
        top: -1em;
    }

    .newSignLogin .forgot-link {
        color: lightgrey;
        text-decoration: underline;
    }

    .newSignLogin input[type="submit"] {
        width: 100%;
        letter-spacing: 3px;
        border-radius: 8px;
    }

    @media (max-width: 1300px) {
        .newSignLogin#container {
            width: 50%;
        }
    }
    @media (max-width: 1000px) {
        .newSignLogin#container {
            width: 70%;
        }
    }
    @media (max-width: 900px) {
        .newSignLogin#container {
            width: 80%;
        }
    }
    @media (max-width: 700px) {
        .newSignLogin#container {
            width: 95%;
        }
    }
</style>

<!-- Sign Up / Login Section -->
<div id="container" class="newSignLogin">
    <div id="buttons">
        <input type="button" class="button signup" value="Sign Up">
        <input type="button" class="button login active" value="Log In">
    </div>

    <form class="login-form" method="POST" action="{{action('Auth\AuthController@postLogin')}}">
        {!! csrf_field() !!}
        <h2 class="message fc-grey">Welcome back!</h2>
        <input type="email" class="form-control" name="email" placeholder="Email Address *">
        <input type="password" class="form-control" name="password" placeholder="Password *">
        <div class="forgot-pass"><a href="{{action('Auth\PasswordController@postEmail')}}"><span class="forgot-link">Forgot Password?</span></a></div>
        <input type="submit" class="btn btn-lg" name="submit" value="Log in">
    </form>

    <form class="signup-form hide" method="POST" action="{{action('Auth\AuthController@postRegister')}}">
        {!! csrf_field() !!}
        <h2 class="message fc-grey" style="line-height:40px;">Ready to Play? <br />Sign Up for Free!</h2>
        <input type="text" class="form-control first-name" name="first_name" placeholder="First Name *">
        <input type="text" class="form-control last-name" name="last_name" placeholder="Last Name *">
        <input type="text" class="form-control first-name" name="username" placeholder="Username *">
        <input type="email" class="form-control last-name" name="email" placeholder="Email Adress *">
        <input type="password" class="form-control" name="password" placeholder="Create a Password *">
        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password *">
        <input type="submit" class="btn btn-lg" name="submit" value="Get Started">
    </form>

    @if (count($errors) > 0)
        <div class="alert alert-danger" style="margin: 0;margin-top: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@stop
