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
                <h2 class="section-heading">Reset Password</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form method="POST" action="/password/reset">
                    {!! csrf_field() !!}
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label class="fc-grey">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="fc-grey">New Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="fc-grey">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    @if (count($errors) > 0)
                    <div class="alert alert-danger clear" style="margin: 0;margin-top: 15px;">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="text-right margin-top-20">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success margin-right-10">Reset Password</button>
                            <a href="/" class="btn btn-danger">CANCEL</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@stop
