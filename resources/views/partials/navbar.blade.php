<style type="text/css">
    .navbar-custom {
        background: rgba(0, 0, 0, .5);
        padding: 10px 0
    }
    .signupLi {
        border:1px solid #fed136;
        width: 135px;
    }
    .signupLi:hover {
        background-color: #fed136;
    }
    .signupLi>a {
        color: #fed136!important;
    }
    .signupLi>a:hover {
        color: #000!important;
    }

    .navbar-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        z-index: 20;
        margin-top: 20px;
    }

    .navbar-wrapper .container {
        padding-left: 0;
        padding-right: 0;
    }

    .navbar-wrapper .navbar {
        padding-left: 15px;
        padding-right: 15px;
    }

    .navbar-content {
        width:320px;
        padding: 15px;
        padding-bottom:0px;
        background-color: #222;
    }

    .navbar-content:before, .navbar-content:after {
        display: table;
        content: "";
        line-height: 0;
    }

    .navbar-nav {
        margin: 0px;
    }
    .navbar-nav.navbar-right:last-child {
        /*margin-right: 15px !important;*/
    }
    .navbar-header .fa-bars {
        font-size: 1.5em;
    }
    .navbar-footer {
        background-color:#333;
    }

    .navbar-footer-content {
        padding:15px 15px 15px 15px;
    }
    .navbar-footer-content>.row a {
        background-color: #222;
        color: #fed136!important;
    }
    .navbar-footer-content>.row a:hover {
        color: #000!important;
        background-color: #fed136;
        border-color: #000;
    }
    .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus, .navbar-default .navbar-nav > .open > a:active, .navbar-default .navbar-nav > .open > a:visited {background-color: rgb(0 ,0 ,0 ,0.5);}
    .dropdown-menu {
        padding: 0px;
        /*overflow: hidden;*/
    }
    .smallGreyBorder {
        border:1px solid lightgrey;
    }
    .viewDashBtn, .viewDashBtn:focus, .viewDashBtn:active, .viewDashBtn:visited {
        background-color: #fed136!important;
        color: #000!important;
    }
    .viewDashBtn:hover{
        background-color:#fec503!important;
    }
    .editAccount {
        color: lightgrey!important;
    }
    .editAccount:hover {
        color: #fff!important;
    }
    .showOnMobile {
        display: none!important;
    }
    @media (max-width: 767px){
        .userAccount {
            display: none!important;
        }
        .showOnMobile {
            display: block!important;
        }
    }
    #mainNav>.container {
        width: 65%;
    }
    @media (max-width: 1300px) {
        #mainNav>.container {
            width: 95%;
        }
    }
    .userAccount {
        width: 90px;
        height: 50px;
    }
    .nav {
        text-align: center;
    }
    @media (max-width: 767px) {
        .nav>li {
            width: auto!important;
        }
        #mainNav {
            background-color: #222;
            padding: 10px 0px 0px;
            margin:0px;
        }
    }
    .navbar-custom .navbar-toggle, .navbar-custom .navbar-toggle:hover {
    float: right;
    padding: 9px 25px;
    /* padding: 9px 10px; */
    margin: 0px;
    background-color: unset;
    border: none;
    font-size: 22px;
    }
    .menuTextColor {
        color: #fed136;
    }

    .logoName {
        font-style: italic;
        font-family: 'Graduate', cursive!important;
        padding-right: 5px;
    }
    #mainNav .logoName {
        font-size: 3em;
    }
    .logoImage {
        width: 3em;
        height: 3em;
        float: left;
        margin-top: 3px;
    }
    .welcome .logoName {
        font-size: 1em;
        padding-left: 0px;
    }
    .welcome .logoImage {
        width: 1em;
        height: 1em;
    }
    .navbar-default .navbar-toggle:focus, .navbar-default .navbar-toggle:hover {
        background-color: unset!important;
    }



</style>

<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top" style="margin-bottom: 0px">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" style="background-color:none!important;" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> <span class="menuTextColor"><i class="fa fa-bars"></i></span>
            </button>
            <a class="showSection">
                <span class="navbar-brand logoName">PICK</span>
                <span><img class="logoImage"  src="/img/pick6_logo.png" onContextMenu="return false;"></span>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <li class="showOnMobile"><a href="/play">Play Game</a></li>
                    <li class="showOnMobile"><a class="showSection">Dashboard</a></li>
                    <li class="showOnMobile"><a href="{{action('Auth\AuthController@getLogout')}}">Log Out</a></li>

                    <!-- User Account Dropdown -->
                    <li class="dropdown userAccount">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding: 5px">
                            <img style="width: 40px;height: 40px;border-radius: 50%;display: inline-block;vertical-align: bottom" src="/img/profilePics/{{Auth::user()->avatar}}" alt="Profile Picture" class="img-responsive smallGreyBorder"/>
                            <i class="caret"></i>
                        </a>
                        @include('partials.accountDropdown')
                    </li>
                    <!-- End of User Account Dropdown -->
                @else
                    <li><a class="showSection">About</a></li>
                    <li><a class="showSection">How To Play</a></li>
                    <li><a class="showSection">Contact Us</a></li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
