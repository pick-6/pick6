@extends('layouts.master')

@section('content')

<style type="text/css">
    header.welcome {
        height: 100vh;
    }
@media (max-width: 991px) {
    .howItWorks #charityArrow {
        font-size: 3rem;
        text-align: center;
        margin: 30px 0px;
    }
}
@media (min-width: 992px) {
    .howItWorks {
        position: relative;
        height: calc(100vh - 65px);
        padding: 80px 0px 0px 0px;
    }
    .howItWorks #charityArrow {
        position: absolute;
        left: calc(50% - 15px);
        bottom: 40px;
        font-size: 3rem;
    }
    .featCharities {
        height: calc(100vh - 235px);
        padding: 0px;
    }
    .featCharities>.container {
        position: relative;
        height: 100%;
        padding: 40px;
    }
    .featCharities .featCharitiesLogos {
        position: absolute;
        left: calc(50% - 545px);
        top:calc(50% - 105px);
    }
    .featCharities #seeCharities {
        font-size: 3rem;
        left: calc(50% - 132px);
        position: absolute;
        bottom: 40px;
    }
}
</style>

    <!-- Welcome To Pick 6! Section -->
    <header class="welcome">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">
                    Welcome To 
                    <div style="display:inline-flex;">
                        <span class="navbar-brand logoName fc-yellow" href="/">PICK</span>
                        <span><img class="logoImage" src="/img/pick6_logo.png" onContextMenu="return false;"></span>
                    </div>!
                </div>
                <div class="intro-heading">Where everyone wins!</div>
                <div class="intro-paragraph box_textshadow fs-20"><span class="fc-yellow">Pick6</span> is the fun and easy way to contribute a small amount to charities you love, test your football knowledge, and compete against your friends and family - all at the same time! We have over <a href="/charities" class="italic">3,000</a> charities to choose from.</div>
                <div class="fs-20 margin-top-20 box_textshadow"><a href="<?= (Auth::check()) ? '/' : '#signup' ?>" data-toggle="modal">Signup</a> today and start playing now!</div>
                <div class="scroll margin-top-75">
                    <a href="#howItWorks" class="btn btn-lg">See How It Works</a>
                </div>
            </div>
        </div>
    </header>

    <!-- How It Works Section -->
    <section class="howItWorks" id="howItWorks">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading fc-white">How It Works</h2>
                </div>
            </div>
            <div class="row text-center" style="margin-top: 30px">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-hand-pointer-o fa-stack-1x fa-inverse icons"></i>
                    </span>
                    <h4 class="service-heading fc-white"><em>Step 1:</em></h4>
                    <p class="text-muted">Choose a square you believe will be the lucky winner. (Multiple squares increase your chances to win.)</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-usd fa-stack-1x fa-inverse icons"></i>
                    </span>
                    <h4 class="service-heading fc-white"><em>Step 2:</em></h4>
                    <p class="text-muted">Decide the amount you wish to donate to the charity pool. ($6, $10, or $20 per square.)</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-users fa-stack-1x fa-inverse icons"></i>
                    </span>
                    <h4 class="service-heading fc-white"><em>Step 3:</em></h4>
                    <p class="text-muted">Sit back, watch the game, and see your contributions benefit the communities in need.</p>
                </div>
            </div>
            <div class="row text-center">
                <div class="margin-0-auto">
                    @if (Auth::check())
                        <a href="/play" class="btn btn-xl getStartedBtn">Start Playing</a>
                    @else
                        <a href="#signup" data-toggle="modal" class="btn btn-xl getStartedBtn">Get Started</a>
                    @endif
                </div>
            </div>
            <div id="charityArrow" class="scroll">
                <a href="#featCharities"><i class="fa fa-chevron-down" aria-hidden="true"></i></a>
            </div>
        </div>
    </section>

    <!-- Featured Charities Section -->
    <section class="featCharities" id="featCharities">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Featured Charities</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row text-center featCharitiesLogos">
                <div class="col-md-4">
                    <img class="img-responsive" style="height: auto" src="/img/maw.png">
                </div>
                <div class="col-md-4">
                    <img class="img-responsive" style="height: auto" src="/img/arc.png">
                </div>
                <div class="col-md-4">
                    <img class="img-responsive" style="height: auto" src="/img/acs.png">
                </div>
            </div>
            <div id="seeCharities" class="row text-center" style="padding: 20px 0px;">
                <a href="/charities" class="btn btn-xl allCharitiesBtn">See All Charities</a>
            </div>
        </div>
    </section>
  
@stop