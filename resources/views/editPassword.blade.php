@extends('layouts.master')
@section('content')

<section style="height: calc(100vh - 165px);">
<h1 class="text-center">Change Password</h1>
<div class="" style="width: 35%;margin: 0 auto;">

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="">
    {!! csrf_field() !!}

    <div class="form-group">
        <label>New Password</label>
        <input type="password" name="password" placeholder="Password" class="form-control loginSignupPage">
    </div>

    <div class="form-group">
        <label>Confirm New Password</label>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control loginSignupPage">
    </div>

    <div class="form-group">
    {{ method_field('PUT') }}
        <button type="submit" style="color: black;font-family: 'Montserrat', sans-serif;font-weight: bold;" class="btn btn-success">Update</button>
        <a href="{{action('AccountController@index', [Auth::user()->username])}}" style="color: black;font-family: 'Montserrat', sans-serif;font-weight: bold;" class="btn btn-danger pull-right">Cancel</a>
    </div>
</form>
</div>
</section>

@stop