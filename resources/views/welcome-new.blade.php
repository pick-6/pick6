@extends('layouts.master')
@section('content')

<style type="text/css">

    #container {
        /* background-color: #222; */
      background-color: #2e2e2e;
      width: 40%;
      margin: auto;
      margin-top: 50px;
      padding: 2em;
      border-radius: 8px;
      border: hidden;
      opacity: .98;
    }

    #buttons,
    .login-form,
    .signup-form {
      display: grid;
      grid-template-columns: 1fr 1fr;
    }

    .message {
       grid-column: 1/3;
       align-self: center;
       text-align: center;
       margin: 1em;
    }


    .signup,
    .login {
      height: 3em;
      display: flex;
      align-items: center;
      justify-content: center;
      border: hidden;
      font-size: large;
      font-weight: bold;
      color: #fff;
      cursor: pointer;
      background-color: #fff4;
    }


    .signup {
      border-radius: 8px 0 0 8px;

    }


    .login {
      border-radius: 0 8px 8px 0;
      background-color: #fff4;
    }

    .active {
      background-color: #fed136;
      color: #111;
    }

    .hide {
      display: none;

    }
    .form-input {
      grid-column: 1/3;
      height: 2em;
      border: hidden;
      border-radius: 8px;
      font-family: 'Montserrat', sans-serif;
      padding-left: 1em;
      font-size: 0.9em;
      margin-bottom: 2em;
      background-color: #fff4;
    }


    ::placeholder {
      color: #fff;
    }


    .forgot-pass {
      grid-column: 1/3;
      text-align: right;
      font-size: 0.8em;
      position: relative;
      top: -1em;
    }


    .button,
    .forgot-link {
      cursor: pointer;
    }

    .forgot-link {
        color: lightgrey;
        text-decoration: underline;
    }

    input {
        color: #fec503;
    }


    input[type="submit"] {
      grid-column: 1/3;
      height: 3em;
      padding: 0;
      background-color: #fed136;
      border: hidden;
      border-radius: 8px;
      text-transform: uppercase;
      font-size: large;
      font-weight: 800;
      letter-spacing: 3px;
      color: #111;
    }


    .form-input:focus {
      box-shadow: 0 0 0 1px #FEC503;
    }


    input {
      outline: none;
    }


    .button:hover {
      background-color: #FEC503;
      color: #111;
    }


    @media (max-width: 1300px) {
      #container {
        width: 50%;
      }
    }
    @media (max-width: 1000px) {
      #container {
        width: 70%;
      }
    }
    @media (max-width: 900px) {
      #container {
        width: 80%;
      }
    }
    @media (max-width: 700px) {
      #container {
        width: 95%;
      }
    }
    @media (min-width: 700px) {
      .first-name {
        grid-column: 1/2;
        margin-right: 1em;
      }
      .last-name {
        grid-column: 2/3;
        margin-left: 1em;
      }
    }
</style>

@if (Auth::check())
	<?php
        header('Location: dashboard');
        exit;
    ?>
@else
    @include('SignUpLogin')
@endif

@stop