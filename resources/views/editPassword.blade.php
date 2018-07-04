@extends('layouts.master')

@section('content')

<style type="text/css">
    section#contact.editAccount label {
        position: relative!important;
        top: 25px!important;
        font-size: 12px;
        left: 5px;
    }
    section#contact.editAccount .form-group input {
        padding: 25px 20px 10px 20px;
    }
    .updBtn {
        padding: 5px;
        border-radius: 3px;
        min-height: 35px;
        text-align: center;
        vertical-align: middle;
    }
    .updBtn:hover {
        text-decoration: none;
    }
    #container {
        max-width: 800px;
        margin: 0 auto;
    }
    .form-group {
        margin: 0!important;
    }
</style>

<section id="contact" class="editAccount" style="background: none;padding: 40px 20px 20px 20px;text-align: left;">
    <div id="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Change Password</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form method="POST" action="{{action('AccountController@updatePassword')}}">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="form-group">
                            <label class="fc-grey">New Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="fc-grey">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                        <div class="col-lg-12" style="margin-top: 20px">
                            <div class="form-group">
                                {{ method_field('PUT') }}
                                <a href="{{action('AccountController@dashboard')}}" style="padding-top:9px;color: black;font-family: 'Montserrat', sans-serif;font-weight: bold;" class="updBtn btn-danger pull-right">CANCEL</a>
                                <button type="submit" style="margin-right:30px;color: black;font-family: 'Montserrat', sans-serif;font-weight: bold;" class="updBtn btn-success pull-right">UPDATE</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@stop
