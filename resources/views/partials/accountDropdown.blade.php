                    <ul class="dropdown-menu accountDropdown">
                        <li>
                            <div class="navbar-content">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="smallGreyBorder">
                                            <img src="/img/profilePics/{{Auth::user()->avatar}}" alt="Profile Picture" class="img-responsive"/>
                                        </div>
                                        <form enctype="multipart/form-data" action="{{action('AccountController@uploadProfilePic')}}"  method="POST">
                                            <input type="file" name="avatar" id="chooseProfilePic" class="hidden">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" id="sumbitProfilePic" class="hidden">
                                        </form>
                                        <p class="text-center small">
                                            <a href="#"><small id="changePhoto">Change Photo</small></a>
                                        </p>
                                    </div>
                                    <div class="col-md-7">
                                        <span style="color: #fed136">{{Auth::user()->first_name}} {{Auth::user()->last_name}} <a class="editAccount" href="{{action('AccountController@edit')}}"><i class="fa fa-edit" style="margin-left: 5px"></i></a></span>
                                        <span style="color: lightgrey">{{Auth::user()->username}}</span>
                                        <p class="text-muted small">{{Auth::user()->email}}</p>
                                        <div class="divider"></div>
                                        <a href="{{action('AccountController@dashboard')}}" class="closeDrop btn btn-primary btn-sm active viewDashBtn">View Dashboard</a>
                                    </div>
                                </div>
                            </div>
                            <div class="navbar-footer">
                                <div class="navbar-footer-content">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="{{action('AccountController@editPassword')}}" class="closeDrop btn btn-default btn-sm">Change Password</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{action('Auth\AuthController@getLogout')}}" class="closeDrop btn btn-default btn-sm pull-right">Log Out</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
