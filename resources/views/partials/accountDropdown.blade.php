<ul class="dropdown-menu accountDropdown">
    <li>
        <div class="navbar-content">
            <div class="row">
                <div class="col-sm-5 padding-r-5">
                    <div class="smallGreyBorder">
                        <img style="height:105px!important;" src="/img/profilePics/{{Auth::user()->avatar}}" alt="Profile Picture" class="img-responsive width100"/>
                    </div>
                    <form enctype="multipart/form-data" action="{{action('AccountController@uploadProfilePic')}}"  method="POST">
                        <input type="file" name="avatar" id="chooseProfilePic" class="hidden">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" id="submitProfilePic" class="hidden">
                    </form>
                    <p class="text-center small">
                        <a href="#"><small id="changePhoto">Change Photo</small></a>
                    </p>
                </div>
                <div class="col-sm-7">
                    <div class="fc-yellow">{{Auth::user()->first_name}} {{Auth::user()->last_name}} <a class="editAccount" href="{{action('AccountController@edit')}}"><i class="fa fa-edit margin-left-5"></i></a></div>
                    <div class="fc-grey">{{Auth::user()->username}}</div>
                    <div class="text-muted small">{{Auth::user()->email}}</div>
                    <div class="divider"></div>
                    <a href="{{action('AccountController@dashboard')}}" class="closeDrop btn btn-primary btn-sm active viewDashBtn">View Dashboard</a>
                </div>
            </div>
        </div>
        <div class="navbar-footer">
            <div class="navbar-footer-content">
                <div class="row">
                    <div class="col-sm-6">
                        <a href="{{action('AccountController@editPassword')}}" class="closeDrop btn btn-default btn-sm">Change Password</a>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{action('Auth\AuthController@getLogout')}}" class="closeDrop btn btn-default btn-sm pull-right">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </li>
</ul>
