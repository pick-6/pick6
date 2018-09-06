@extends('layouts.master')
@section('content')
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
                    <form enctype="multipart/form-data" action="{{action('AccountController@uploadProfilePic')}}" method="POST">
                        <input type="file" name="avatar" id="chooseProfilePic" class="hidden chooseProfilePic">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" id="submitProfilePic" class="hidden submitProfilePic">
                    </form>
                    <a href="#" id="changePhoto" class="changePhoto">
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
            <div>
                <ul class="padding-0 text-left">
                    <a href="#addCreditModal" data-toggle="modal">
                        <li class="padding-10 fc-grey fs-18 addCredit ellipsis">
                            <span class="inline-block" style="min-width:25px;">
                                <i class="fas fa-dollar-sign" ></i><i class="fas fa-dollar-sign"></i>
                            </span>
                            Add Credit
                        </li>
                    </a>
                    <a href="{{action('AccountController@edit')}}">
                        <li class="padding-10 fc-grey fs-18 editInfo ellipsis">
                            <span class="inline-block" style="min-width:25px;">
                                <i class="fas fa-edit"></i>
                            </span>
                            Edit Info
                        </li>
                    </a>
                    <a href="{{action('AccountController@editPassword')}}">
                        <li class="padding-10 fc-grey fs-18 changePassword ellipsis">
                            <span class="inline-block" style="min-width:25px;">
                                <i class="fas fa-key"></i>
                            </span>
                            Change Password
                        </li>
                    </a>
                    <a href="#deleteAccountModal" data-toggle="modal">
                        <li class="padding-10 fc-grey fs-18 deleteAccount ellipsis">
                            <span class="inline-block" style="min-width:25px;">
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
                <a href="#currentGames" class="btn btn-lg">See Current Games</a>
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
                        <a href="/play" class="btn btn-xl startPlayingBtn">JOIN A GAME</a>
                    </div>
                @endif
            </div>
        @endif
    </section>
</div>
@stop
