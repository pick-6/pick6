<style>
    #sidebar ul li {
        list-style: none;
        background-color:#32333B;
        border-left: 6px solid;
        margin-bottom: 1px;
        text-transform: uppercase;
        font-weight: bold;
    }
    #sidebar ul li:hover {
        cursor: pointer;
        color: #000!important;
    }
    #sidebar ul a:hover {
        text-decoration: none;
    }
    #sidebar ul li.editInfo {
        border-color: #5cb85c;
    }
    #sidebar ul li.editInfo:hover {
        background-color:#449d44;
        border-color:#449d44;
    }
    #sidebar ul li.changePassword {
        border-color: #fed136;
    }
    #sidebar ul li.changePassword:hover {
        background-color:#FEC503;
        border-color:#FEC503;
    }
    #sidebar ul li.deleteAccount {
        border-color: #d9534f;
    }
    #sidebar ul li.deleteAccount:hover {
        background-color:#c9302c;
        border-color:#c9302c;
    }
</style>
<div>
    <section id="sidebar" class="padding-0 text-center" style="background-color: #202125;">
        <div class="padding-10">
            <div class="margin-bottom-10 fc-yellow">
                <h3 class="margin-0">
                    {{$first_name}}
                    {{$last_name}}
                </h3>
                <p class="fc-grey margin-0">
                    {{$username}}
                </p>
                <p class="text-muted">
                    {{$email}}
                </p>
            </div>
            <div style="max-width:275px;height:275px;background-image: url('/img/profilePics/{{$avatar}}');background-size: cover;" class="margin-0-auto showUserContainer smallGreyBorder">
                <form enctype="multipart/form-data" action="{{action('AccountController@uploadProfilePic')}}" method="POST">
                    <input type="file" name="avatar" id="chooseProfilePic" class="hidden chooseProfilePic">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" id="submitProfilePic" class="hidden submitProfilePic">
                </form>
                <a href="#" id="changePhoto" class="changePhoto">
                    <div class='showUserBG'>
                        <p class="text-center fc-white" style="margin-top:35%;font-size:2rem;">
                            <i class="fas" style="font-size:6rem;"></i><br />
                            <small class="uppercase showUserName"></small>
                        </p>
                    </div>
                </a>
            </div>
        </div>
            <div>
                <ul class="padding-0 text-left">
                    <a href="{{action('AccountController@edit')}}">
                        <li class="padding-10 fc-grey fs-18 editInfo">
                            Edit Info
                        </li>
                    </a>
                    <a href="{{action('AccountController@editPassword')}}">
                        <li class="padding-10 fc-grey fs-18 changePassword">
                            Change Password
                        </li>
                    </a>
                    <a href="{{action('AccountController@destroy', [Auth::id()])}}">
                        <li class="padding-10 fc-grey fs-18 deleteAccount">
                            Delete Account
                        </li>
                    </a>
                </ul>
            </div>
    </section>
</div>
