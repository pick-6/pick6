    <a href="#" class="dropdown-toggle padding-5" data-toggle="dropdown">
        <img src="/img/profilePics/{{Auth::user()->avatar}}" alt="Profile Picture" class="img-responsive smallGreyBorder inline-block bottom" style="width: 40px;height: 40px;border-radius: 50%;"/>
        <i class="caret"></i>
    </a>
    @include('partials.navbar.accountDropdown')
