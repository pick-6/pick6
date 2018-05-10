@extends('layouts.master')

@section('content')
<section>
<h1 style="color: white" class="text-center">Edit Account</h1>
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
<form method="POST" action="{{action('AccountController@update')}}">
    {!! csrf_field() !!}

    <div class="form-group">
        <label>First Name</label>
        <input type="text" name="first_name" value="{{ Auth::user()->first_name }}" placeholder="First Name" class="form-control loginSignupPage">
    </div>

    <div class="form-group">
        <label>Last Name</label>
        <input type="text" name="last_name" value="{{ Auth::user()->last_name }}" placeholder="Last Name" class="form-control loginSignupPage">
    </div>

    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" value="{{ Auth::user()->username }}" placeholder="Username" class="form-control loginSignupPage">
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ Auth::user()->email }}" placeholder="Email" class="form-control loginSignupPage">
    </div>

    <div class="form-group">
    {{ method_field('PUT') }}
        <button type="submit" style="color: black;font-family: 'Montserrat', sans-serif;font-weight: bold;" class="btn btn-success">UPDATE</button>
        <a href="{{action('AccountController@dashboard')}}" style="color: black;font-family: 'Montserrat', sans-serif;font-weight: bold;" class="btn btn-danger pull-right">CANCEL</a>
    </div>
</form>
</div>
</section>
@stop
