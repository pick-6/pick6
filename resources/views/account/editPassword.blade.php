@extends('layouts.master')
@section('content')

<style type="text/css">
    section#contact.editPassword label {
        position: relative!important;
        top: 25px!important;
        font-size: 12px;
        left: 5px;
    }
    section#contact.editPassword .form-group input {
        padding: 25px 20px 10px 20px;
    }
    section#contact.editPassword #container {
        max-width: 800px;
        margin: 0 auto;
    }
    section#contact.editPassword .form-group {
        margin: 0!important;
    }
</style>

<section id="contact" class="editPassword" style="background: none;padding: 40px 20px 20px 20px;text-align: left;">
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
                        <div class="col-lg-12 padding-0" style="margin-top: 20px">
                            <div class="form-group text-right">
                                {{ method_field('PUT') }}
                                <button type="submit" class="btn btn-success margin-right-10">UPDATE</button>
                                <a href="/dashboard" class="btn btn-danger">CANCEL</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@stop
