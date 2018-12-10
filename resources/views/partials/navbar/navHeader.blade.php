<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
    <!-- Brand -->
    <a data-role-ajax="{{ Auth::check() ? '/dashboard' : '/SignUpLoginView'}}">
        <!-- <span class="navbar-brand logoName">PICK</span> -->
        <span><img class="logoImage"  src="/img/pick6_logo_new1.png" onContextMenu="return false;"></span>
    </a>

    <!-- Hamburger -->
    <button type="button" class="navbar-toggle" style="background-color:none!important;" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span> <span class="menuTextColor"><i class="fa fa-bars"></i></span>
    </button>
</div>
