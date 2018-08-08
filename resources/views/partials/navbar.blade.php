<?php
use App\User;
?>
<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top margin-bottom-0">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" style="background-color:none!important;" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> <span class="menuTextColor"><i class="fa fa-bars"></i></span>
            </button>
            <a href="/">
                <span class="navbar-brand logoName">PICK</span>
                <span><img class="logoImage"  src="/img/pick6_logo_low.png" onContextMenu="return false;"></span>
            </a>
        </div>

        @if (Auth::check())
            <?php
                $creditForUser = User::select('credit')->where('id', '=', Auth::user()->id)->get();
                $credit = $creditForUser[0]['credit'];
                $creditAmount = money_format('$%i', $credit);
            ?>
            <div class="fc-grey hideOnMobile" style="position: absolute;left:40%;top:25px;">
                <div class="col-sm-8" style="padding:20px;margin-top:-15px">
                    Credit Balance: <span class="{{ $credit <= 0 ? 'fc-red' : 'fc-green'}} creditBalance" id="creditBalance" data-balance="{{$credit}}">{{$creditAmount}}</span>
                </div>
                <div class="col-sm-4" style="padding:0px;">
                    <a href="#addCreditModal" data-toggle="modal" class="btn btn-success btn-sm">
                        <i class="fas fa-dollar-sign"></i> Add Credit
                    </a>
                </div>
            </div>
        @endif

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <!-- <li class="showOnMobile">
                        <a href="#addCreditModal" data-toggle="modal" class="btn btn-success btn-sm margin-top-10" style="font-weight:bold;font-size: 14px;">
                            <i class="fas fa-dollar-sign"></i> Add Credit
                        </a>
                    </li> -->
                    <li class="showOnMobile"><a href="/dashboard">Dashboard</a></li>
                    <li class="showOnMobile"><a href="/account">My Profile</a></li>
                    <li class="showOnMobile"><a href="/play">View Games</a></li>
                    <li class="showOnMobile"><a href="{{action('Auth\AuthController@getLogout')}}" class="fc-yellow">Log Out</a></li>

                    <!-- User Account Dropdown -->
                    <li class="dropdown userAccount hideOnMobile">
                        <a href="#" class="dropdown-toggle padding-5" data-toggle="dropdown">
                            <img style="width: 40px;height: 40px;border-radius: 50%;display: inline-block;vertical-align: bottom" src="/img/profilePics/{{Auth::user()->avatar}}" alt="Profile Picture" class="img-responsive smallGreyBorder"/>
                            <i class="caret"></i>
                        </a>
                        @include('account.accountDropdown')
                    </li>
                    <!-- End of User Account Dropdown -->
                @else
                    <!-- <li><a href="/about">About</a></li>
                    <li><a href="/howtoplay">How To Play</a></li>
                    <li><a href="/contact">Contact Us</a></li>
                    <li><a href="/" class="fc-yellow">Signup / Login</a></li> -->
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
