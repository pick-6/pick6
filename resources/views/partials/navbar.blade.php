<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> <span class="menuTextColor">Menu <i class="fa fa-bars"></i></span>
            </button>
            <a class="navbar-brand" id="logoName" href="/home">PICK</a>
            <a href="/home"><img class="logoImage"  src="/img/pick6.png" onContextMenu="return false;"></a> 
        </div>
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/home">Home</a></li>
                @if (Auth::check())
                    <li><a href="/play">Play Game</a></li>
                    <li><a href="{{action('AccountController@show', [Auth::user()->username])}}">Account</a></li>
                    <li><a href="{{action('Auth\AuthController@getLogout')}}">Logout</a></li>
                @else
                    <li><a href="/howtoplay">How To Play</a></li>
                    <li><a href="/charities">Charities</a></li>
                    <li><a href="{{action('Auth\AuthController@getRegister')}}">Signup</a></li>
                    <li><a href="{{action('Auth\AuthController@getLogin')}}">Login</a></li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>