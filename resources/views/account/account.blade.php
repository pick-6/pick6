
<style>
    #accountPage .showAvatarContainer {
        background-image: url('/img/profilePics/{{$avatar}}');
    }
</style>
<div class="text-center" id="accountPage">
    <section id="accountInfo" class="padding-0 col-md-3">
        <div class="padding-10">
            <div class="margin-bottom-10 fc-yellow">
                @if(Auth::user()->email == 'mattvaldez01@gmail.com')
                    <p class="fc-red margin-0">
                        User Id: {{$id}}
                    </p>
                @endif
                <h3 class="margin-0 ellipsis" style="white-space: normal;">
                    {{$first_name}}
                    {{$last_name}}
                </h3>
                <p class="fc-grey margin-0 ellipsis">
                    {{$username}}
                </p>
                @if($isLoggedInUser)
                    <p class="text-muted ellipsis">
                        {{$email}}
                    </p>
                @endif
            </div>
            <div class="margin-0-auto showAvatarContainer smallGreyBorder">
                @if($isLoggedInUser)
                    <form id="changeProfileImage" enctype="multipart/form-data" action="{{action('AccountController@uploadProfilePic')}}" method="POST">
                        <input type="file" name="avatar" id="chooseProfilePic" class="hidden chooseProfilePic">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" id="submitProfilePic" class="hidden submitProfilePic">
                    </form>
                    <a id="changePhoto" class="changePhoto">
                        <div class='showAvatarBG'>
                            <p class="text-center fc-white" style="margin-top:60px;font-size:2rem;">
                                <i class="fas" style="font-size:6rem;"></i><br />
                                <small class="uppercase showAvatar"></small>
                            </p>
                        </div>
                    </a>
                @endif
            </div>
            @include('account.additionalInfo')
        </div>
        @if($isLoggedInUser)
            <style>
                .settings {
                    border: 1px solid #444;
                    /* box-shadow: 1px 1px 5px #333; */
                }
                .settings:hover, .open .settings {
                    background: #111;
                }
            </style>
            <div class="absolute dropdown hideOnTablet" style="bottom:0;padding-bottom:10px">
                <a class="dropdown-toggle no-decor" data-toggle="dropdown">
                    <div class="padding-5 fc-grey fs-18 addCredit ellipsis settings">
                        <span class="inline-block" style="min-width:25px;">
                            <i class="fas fa-cog"></i>
                            <!-- <small class="uppercase bold">Account Settings</small> -->
                        </span>
                    </div>
                </a>
                <ul class="dropdown-menu padding-0 text-left" style="top:-30px;left: 45px;background:#444">
                    <a href="#addCreditModal" data-toggle="modal">
                        <li class="padding-10 fc-grey fs-18 addCredit ellipsis">
                            <span class="inline-block text-center" style="min-width:25px;">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                            Add Credit
                        </li>
                    </a>
                    <a data-role-ajax="{{action('AccountController@edit')}}">
                        <li class="padding-10 fc-grey fs-18 editInfo ellipsis">
                            <span class="inline-block text-center" style="min-width:25px;">
                                <i class="fas fa-edit"></i>
                            </span>
                            Edit Info
                        </li>
                    </a>
                    <a data-role-ajax="{{action('AccountController@editPassword')}}">
                        <li class="padding-10 fc-grey fs-18 changePassword ellipsis">
                            <span class="inline-block text-center" style="min-width:25px;">
                                <i class="fas fa-key"></i>
                            </span>
                            Change Password
                        </li>
                    </a>
                    <a href="#deleteAccountModal" data-toggle="modal">
                        <li class="padding-10 fc-grey fs-18 deleteAccount ellipsis">
                            <span class="inline-block text-center" style="min-width:25px;">
                                <i class="fas fa-trash-alt"></i>
                            </span>
                            Delete Account
                        </li>
                    </a>
                </ul>
            </div>
            <div class="showOnTablet">
                <ul class="padding-0 text-left">
                    <a href="#addCreditModal" data-toggle="modal">
                        <li class="padding-10 fc-grey fs-18 addCredit ellipsis">
                            <span class="inline-block text-center" style="min-width:25px;">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                            Add Credit
                        </li>
                    </a>
                    <a data-role-ajax="{{action('AccountController@edit')}}">
                        <li class="padding-10 fc-grey fs-18 editInfo ellipsis">
                            <span class="inline-block text-center" style="min-width:25px;">
                                <i class="fas fa-edit"></i>
                            </span>
                            Edit Info
                        </li>
                    </a>
                    <a data-role-ajax="{{action('AccountController@editPassword')}}">
                        <li class="padding-10 fc-grey fs-18 changePassword ellipsis">
                            <span class="inline-block text-center" style="min-width:25px;">
                                <i class="fas fa-key"></i>
                            </span>
                            Change Password
                        </li>
                    </a>
                    <a href="#deleteAccountModal" data-toggle="modal">
                        <li class="padding-10 fc-grey fs-18 deleteAccount ellipsis">
                            <span class="inline-block text-center" style="min-width:25px;">
                                <i class="fas fa-trash-alt"></i>
                            </span>
                            Delete Account
                        </li>
                    </a>
                </ul>
            </div>
            @include('account.deleteAccount')
        @endif

        @if ($hasCurrentGames)
            <div class="scroll margin-top-75 showOnTablet">
                <a data-href="#currentGames" class="btn btn-lg">See Current Games</a>
            </div>
        @endif
    </section>

    <section id="currentGames" class="padding-10 myCurrentGames col-md-9 {{ $hasCurrentGames ? '' : 'hideOnTablet'}}">
        <h3 class="fc-white margin-top-0">{{$isLoggedInUser ? 'My' : $first_name.'\'s'}} Current Games</h3>
        @if ($hasCurrentGames)
            @include('game.list', ['games' => $currentGames, 'dates' => false])
        @else
            <div style="transform:translateY(10vh);">
                <p class="noGames margin-0-auto fc-grey margin-top-50" style="font-size: 1.5em;">
                    {{$isLoggedInUser ? 'You\'re' : $first_name.'\'s'}} not involved in any games yet.
                </p>
                @if($isLoggedInUser)
                    <div id="startPlayingBtn">
                        <a data-role-ajax="play" class="btn btn-xl startPlayingBtn">JOIN A GAME</a>
                    </div>
                @endif
            </div>
        @endif
    </section>
</div>

<script type="text/javascript">
    $(".scroll a").bind("click",function(t){
        var l = $(this);
        $('html, body').find("section").stop().animate({
            scrollTop:$(l.data("href")).offset().top-65
        },1500)
        t.preventDefault();
    });

    // Upload Profile Pic from Account Page
    $('#accountPage').find('.changePhoto').click(function(){
        $('.chooseProfilePic').trigger('click');
    });

    $('#accountPage').find('.chooseProfilePic')
        .on('click touchstart', function(){
            $(this).val('');
        })
        .change(function(e) {
            $(".submitProfilePic").trigger('click');
        });

    // Change Profile Pic on Account Page
    $('#accountPage').find('.showAvatarContainer').on('mouseover mouseout', function(e){
        if (e.type == 'mouseover')
        {
            $(this).find('.showAvatar').text('Change Photo');
            $(this).find('.showAvatar').parent().find('i').addClass('fa-camera');
            $(this)
            .css({
                'position': 'relative',
                'z-index': '1',
            });
            $(this).find('.showAvatarBG')
            .css({
                'position': 'absolute',
                'z-index': '-1',
                'background': '#000',
                'opacity': '.65',
                'width': '100%',
                'height': '100%'
            });
        }
        else
        {
            $(this).find('.showAvatar').text('');
            $(this).find('.showAvatar').parent().find('i').removeClass('fa-camera');
            $(this).find('.showAvatarBG')
            .css({
                'background': 'initial',
            });
        }
    });

    // Add Favorite Team
    $('#accountPage').find("#chooseFavTeamModal .teamsList td").on('click', function(){
        var team = $(this).data("id");
        var form = $("#chooseFavTeamModal #addFavTeamForm");
        form.append("<input type='hidden' name='favTeam' value='"+team+"'/>");
        form.submit();
    });

    $('#addFavTeamForm').on('submit', function(e){
        e.preventDefault();

        $team = $(this).find('input[name=favTeam]').val();
        $(this).postForm({
            url: "/account/updateFavTeam/"+$team+"",
            reload: "/account",
        });
    });

    $('#changeProfileImage').on('submit', function(e){
        e.preventDefault();

        $(this).uploadFile({
            url: "/upload",
            reload: "/account",
            data: new FormData(this),
            getAvatar: true
        });
    });
</script>
