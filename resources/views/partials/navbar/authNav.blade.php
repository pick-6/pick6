<li class="showOnMobile padding-10">
    <a href="#addCreditModal" data-toggle="modal" class="btn btn-success btn-sm bold fs-14">
        <i class="fas fa-dollar-sign"></i>
        Add Credit
    </a>
</li>
<li class="showOnMobile">
    <a href="/dashboard">
        <span class="inline-block" style="min-width:25px;font-size:1.25em;">
            <i class="fas fa-tachometer-alt"></i>
        </span>
        Dashboard
    </a>
</li>
<li class="showOnMobile">
    <a href="/account">
        <span class="inline-block" style="min-width:25px;font-size:1.25em;">
            <i class="fas fa-user-circle"></i>
        </span>
        My Profile
    </a>
</li>
<li class="showOnMobile">
    <a href="/play">
        <span class="inline-block" style="min-width:25px;font-size:1.25em;">
            <i class="fas fa-football-ball"></i>
        </span>
        View Games
    </a>
</li>
<li class="showOnMobile">
    <a href="{{action('Auth\AuthController@getLogout')}}" class="fc-yellow">
        <span class="inline-block" style="min-width:25px;font-size:1.25em;">
            <i class="fas fa-sign-out-alt"></i>
        </span>
        Log Out
    </a>
</li>

<!-- User Account Dropdown -->
<li class="dropdown userAccount hideOnMobile">
    <a href="#" class="dropdown-toggle padding-5" data-toggle="dropdown">
        <img src="/img/profilePics/{{Auth::user()->avatar}}" alt="Profile Picture" class="img-responsive smallGreyBorder inline-block bottom" style="width: 40px;height: 40px;border-radius: 50%;"/>
        <i class="caret"></i>
    </a>
    @include('partials.navbar.accountDropdown')
</li>
<!-- End of User Account Dropdown -->