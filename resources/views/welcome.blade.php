@extends('layouts.master')

@section('content')

    <!-- Header -->
    <header class="welcome">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Welcome To <span>Pick 6</span>!</div>
                <div class="intro-heading">Where everyone wins!</div>
                <div class="intro-paragraph box_textshadow">We're an organization that connects all sorts of people ranging from the true sports fanatic to the everyday person. Our goal is to bring people together with our competitive, friendly game, while giving back to the communities in need. We achieve this by giving <span>100%</span> of all proceeds from each game to the charity of the winner's choice. So if you're looking for some competitive fun while still being able to help others, look no further. <p><a href="/register">Signup</a> today and start playing!</p></div>
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
                <a href="/register" class="btn btn-xl getStartedBtn">Get Started</a>
            </div>
        </div>
    </section>
  
@stop
