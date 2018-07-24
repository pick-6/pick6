<?php
    $isLoggedInUser = $id == Auth::id();
?>
@extends('layouts.master')
@section('content')
<style>
    .container {
        width: unset;
    }
    @media (min-width: 1200px){
        .container {
            width: 1170px;
        }
    }
    @media(max-width: 767px){
        section#accountInfo {
            background: unset!important;
        }
        #accountPage ul {
            width: 85%;
            margin: 0 auto;
        }
        #pageContent section {
            padding-top: 10px!important;
        }
        #accountPage section {
            height: calc(100vh - 88px)!important;
        }
        #accountPage .userCurrentGames {
            height:calc(100vh - 150px)!important;
        }
    }
    #accountPage .userCurrentGames {
        overflow:auto;
        height:calc(100vh - 265px);
    }
    #accountPage section {
        height:calc(100vh - 200px);
    }
    #accountPage #changePhoto:hover {
        color: var(--yellow-font)!important;
    }
    #accountPage ul li {
        list-style: none;
        background-color:#32333B;
        border-left: 6px solid;
        margin-bottom: 1px;
        text-transform: uppercase;
        font-weight: bold;
    }
    #accountPage ul li:hover {
        cursor: pointer;
        color: #000!important;
    }
    #accountPage ul a:hover {
        text-decoration: none;
    }
    #accountPage ul li.editInfo {
        border-color: #5cb85c;
    }
    #accountPage ul li.editInfo:hover {
        background-color:#449d44;
        border-color:#449d44;
    }
    #accountPage ul li.changePassword {
        border-color: #fed136;
    }
    #accountPage ul li.changePassword:hover {
        background-color:#FEC503;
        border-color:#FEC503;
    }
    #accountPage ul li.deleteAccount {
        border-color: #d9534f;
    }
    #accountPage ul li.deleteAccount:hover {
        background-color:#c9302c;
        border-color:#c9302c;
    }
</style>
<div class="text-center" id="accountPage">
    <section id="accountInfo" class="padding-0 col-sm-3" style="background-color: #202125;">
        <div class="padding-10">
            <div class="margin-bottom-10 fc-yellow">
                <h3 class="margin-0">
                    {{$first_name}}
                    {{$last_name}}
                </h3>
                <p class="fc-grey margin-0">
                    {{$username}}
                </p>
                @if($isLoggedInUser)
                <p class="text-muted">
                    {{$email}}
                </p>
                @endif
            </div>
            <div style="max-width:275px;height:275px;background-image: url('/img/profilePics/{{$avatar}}');background-size: cover;" class="margin-0-auto showAvatarContainer smallGreyBorder">
                @if($isLoggedInUser)
                <form enctype="multipart/form-data" action="{{action('AccountController@uploadProfilePic')}}" method="POST">
                    <input type="file" name="avatar" id="chooseProfilePic" class="hidden chooseProfilePic">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" id="submitProfilePic" class="hidden submitProfilePic">
                </form>
                <a href="#" id="changePhoto" class="changePhoto">
                    <div class='showAvatarBG'>
                        <p class="text-center fc-white" style="margin-top:35%;font-size:2rem;">
                            <i class="fas" style="font-size:6rem;"></i><br />
                            <small class="uppercase showAvatar"></small>
                        </p>
                    </div>
                </a>
                @endif
            <!-- </div> -->
            </div>
        </div>
        @if($isLoggedInUser)
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
        @endif
        @if ($hasCurrentGames)
            <div class="scroll margin-top-75 showOnMobile">
                <a href="#currentGames" class="btn btn-lg">See Current Games</a>
            </div>
        @endif
    </section>

    @if ($hasCurrentGames)
        <section id="currentGames" class="padding-10 myCurrentGames col-sm-9" style="background:#181818;;">
            <h3 class="fc-white margin-top-0">{{$isLoggedInUser ? 'My' : $first_name.'\'s'}} Current Games</h3>
            <div id="no-more-tables" class="table-responsive userCurrentGames">
                <table class="table table-bordered margin-bottom-0">
                    <colgroup>
                        <col>
                        <col style="width: 35%">
                    </colgroup>
                    <tbody>
                        @foreach ($currentGames as $game)
                        <tr>
                            <td class="middle text-center padding-10">
                                <a href="{{action('GamesController@show', [$game->game_id])}}">
                                    <div class="pull-left width50 fs-16">
                                        <img src="/img/team_logos/{{$game->home_logo}}" height="60" width="65" alt="{{$game->home}}">
                                        <div class="text-left middle width60 inline-flex">
                                            {{$game->home}}
                                        </div>
                                    </div>
                                    <div class="pull-right width50 fs-16">
                                        <img src="/img/team_logos/{{$game->away_logo}}" height="60" width="65" alt="{{$game->away}}">
                                        <div class="text-left middle width60 inline-flex">
                                            {{$game->away}}
                                        </div>
                                    </div>
                                </a>
                            </td>

                            <td data-title="" id="playGameBtn" class="middle padding-0">
                                <a href="{{action('GamesController@show', [$game->game_id])}}" class="btn playGameBtn" style="min-width:85%;">
                                    GO TO GAME
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    @endif
</div>
@stop
