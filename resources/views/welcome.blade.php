@extends('layouts.master')

@section('content')

    <!-- Header -->
    <header class="welcome">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Welcome To <span>Pick 6</span>!</div>
                <div class="intro-heading">Where everyone wins!</div>
                <div class="intro-paragraph box_textshadow">Pick 6 is the fun and easy way to contribute a small amount to charities you love, test your football knowledge and compete against friends and family - all at the same time. There are over 3,000 charities to choose from. <p><a href="/register">Signup</a> today and start playing now!</p></div>
            </div>
        </div>
    </header>

    <!-- How It Works Section -->
    <section class="howItWorks">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">How It Works</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-hand-pointer-o fa-stack-1x fa-inverse icons"></i>
                    </span>
                    <h4 class="service-heading"><em>Step 1:</em></h4>
                    <p class="text-muted">Choose a square you believe will be the lucky winner. (Mutiple squares increases your chances to win.)</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-usd fa-stack-1x fa-inverse icons"></i>
                    </span>
                    <h4 class="service-heading"><em>Step 2:</em></h4>
                    <p class="text-muted">Decide the amount you wish to donate to the charity pool. ($5, $10, $20 or more per square.)</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-users fa-stack-1x fa-inverse icons"></i>
                    </span>
                    <h4 class="service-heading"><em>Step 3:</em></h4>
                    <p class="text-muted">Sit back, watch the game, and see your contributions benefit the communities in need.</p>
                </div>
                @if (Auth::check())
                    <a href="/play" class="btn btn-xl getStartedBtn">Start Playing</a>
                @else
                    <a href="/register" class="btn btn-xl getStartedBtn">Get Started</a>
                @endif
            </div>
        </div>
    </section>

    <!-- Featured Charities Section -->
    <section class="featCharities">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Featured Charities</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <img class="img-responsive" src="http://michigan.wish.org/~/media/Shared/200x200%20icons/200x200-Make-A-Wish-Logo.ashx">
                </div>
                <div class="col-md-4">
                    <img class="img-responsive" src="https://adc73194584bc554a722-6c876fe0fcae1416a4d62676b3759245.ssl.cf1.rackcdn.com/client_id_148_media_file_name_1455900624.6597.png">
                </div>
                <div class="col-md-4">
                    <img class="img-responsive" src="http://curebowl.com/media/uploads/2014/09/BCRF_LogoGray-pink.png">
                </div>
                <a href="/charities" class="btn btn-xl allCharitiesBtn">See All Charities</a>
            </div>
        </div>
    </section>

  
@stop
