<?php
$avatar = Auth::user()->avatar;
?>
<style>
    #accountInfo .showAvatarContainer {
        background-image: url('/img/profilePics/{{$avatar}}');
    }
</style>
    <section id="accountInfo" class="padding-0 height100">
        <div class="padding-10">
            <div class="margin-bottom-10 fc-yellow">
                <h3 class="margin-0 ellipsis" style="white-space: normal;">
                    {{Auth::user()->full_name}}
                </h3>
                <p class="fc-grey margin-0 ellipsis">
                    {{Auth::user()->username}}
                </p>
                    <p class="text-muted ellipsis">
                        {{Auth::user()->email}}
                    </p>
            </div>
            <div class="margin-0-auto showAvatarContainer smallGreyBorder">
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
            </div>
            @include('account.additionalInfo')
        </div>
            <div class="absolute dropdown hideOnTablet" style="bottom:0;padding-bottom:10px">
                @include('partials.dropdown.item', [
                    'isDropDownBtn' => true,
                    'icon' => 'cog',
                ])
                <ul class="dropdown-menu new-menu padding-0 text-left" style="top:-30px;left: 45px;background:#444">
                    @include('partials.dropdown.account-items')
                </ul>
            </div>
            <div class="showOnTablet">
                <ul class="padding-0 text-left new-menu">
                    @include('partials.dropdown.account-items')
                </ul>
            </div>
            @include('account.deleteAccount')
    </section>
