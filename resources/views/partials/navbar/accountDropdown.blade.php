<style>
    .accountDropdown .showAvatarContainer {
        background-image: url('/img/profilePics/{{Auth::user()->avatar}}');
    }
</style>
<ul class="dropdown-menu accountDropdown">
    <li>
        <div class="navbar-content">
            <div class="row margin-bottom-10">
                <div class="col-sm-5" style="padding:10px!important;">
                    <div class="margin-0-auto showAvatarContainer smallGreyBorder">
                        <form class="profilePicForm" enctype="multipart/form-data" action="{{action('AccountController@uploadProfilePic')}}" method="POST">
                            <input type="file" name="avatar" id="chooseProfilePic" class="hidden">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" id="submitProfilePic" class="hidden">
                        </form>
                        <a id="changePhoto">
                            <div class='showAvatarBG'>
                                <p class="text-center fc-white" style="margin-top:15px;font-size:1.5rem;line-height:1;">
                                    <i class="fas" style="font-size:4rem;"></i><br />
                                    <small class="uppercase showAvatar"></small>
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-7" style="padding:10px!important;">
                    <div class="fc-yellow" title="{{Auth::user()->full_name}}">
                        <span class="ellipsis inline-block pull-left" style="width:unset;max-width: calc(100% - 22px)!important;">{{Auth::user()->full_name}}</span>
                        <a class="editAccount inline-block top pull-left" data-role-ajax="{{action('AccountController@edit')}}"><i class="fa fa-edit margin-left-5"></i></a>
                    </div>
                    <div class="fc-grey ellipsis clear" title="{{Auth::user()->username}}">{{Auth::user()->username}}</div>
                    <div class="text-muted small ellipsis" title="{{Auth::user()->email}}">{{Auth::user()->email}}</div>
                    <div class="divider"></div>
                    <a data-role-ajax="/account" class="closeDrop btn btn-primary btn-sm active viewDashBtn width100">View My Profile</a>
                </div>
            </div>
        </div>
        <div class="navbar-footer">
            <div class="navbar-footer-content">
                <div class="row">
                    <div class="col-sm-6" style="padding:10px!important;">
                        <a data-role-ajax="/dashboard" class="closeDrop btn btn-default btn-sm">Go to Dashboard</a>
                    </div>
                    <div class="col-sm-6" style="padding:10px!important;">
                        <a data-role-ajax="{{action('Auth\AuthController@getLogout')}}" class="closeDrop logout btn btn-default btn-sm pull-right">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </li>
</ul>
