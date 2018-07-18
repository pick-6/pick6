<?php
    $isLoggedInUser = $id == Auth::id();
?>
@extends('layouts.master')
@section('content')
<style>
    #accountPage .userCurrentGames {
        overflow:auto;
        height:calc(100vh - 350px);
    }
    #accountPage section {
        background:unset;
        height:calc(100vh - 117px);
    }
</style>
<div class="text-center" id="accountPage">
    <section class="padding-0">
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
        <div style="width:275px" class="margin-0-auto">
            <div class="smallGreyBorder">
                <img style="height:250px!important;" src="/img/profilePics/{{$avatar}}" alt="Profile Picture" class="img-responsive width100"/>
            </div>
            @if($isLoggedInUser)
                <form enctype="multipart/form-data" action="{{action('AccountController@uploadProfilePic')}}"  method="POST">
                    <input type="file" name="avatar" id="chooseProfilePic" class="hidden chooseProfilePic">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" id="submitProfilePic" class="hidden submitProfilePic">
                </form>
                <p class="text-center">
                    <a href="#"><small class="changePhoto uppercase fc-white" id="changePhoto">Change Photo</small></a>
                </p>
            @endif
        </div>
        @if($isLoggedInUser)
            <div class="col-xs-12">
                <div class="col-xs-4">
                    <a href="{{action('AccountController@edit')}}" class="btn btn-success btn-sm">
                        Edit Info
                    </a>
                </div>
                <div class="col-xs-4">
                    <a href="{{action('AccountController@editPassword')}}" class="btn btn-primary btn-sm">
                        Change Password
                    </a>
                </div>
                <div class="col-xs-4">
                    <a href="{{action('AccountController@destroy', [Auth::id()])}}" class="btn btn-danger btn-sm">
                        Delete Account
                    </a>
                </div>
            </div>
        @endif
        @if ($hasCurrentGames)
            <div class="scroll margin-top-75">
                <a href="#currentGames" class="btn btn-lg">See Current Games</a>
            </div>
        @endif
    </section>

    @if ($hasCurrentGames)
        <section id="currentGames" class="padding-0 myCurrentGames">
            <h3 class="fc-white">{{$isLoggedInUser ? 'My' : $first_name.'\'s'}} Current Games</h3>
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
                                <a href="{{action('GamesController@show', [$game->game_id])}}" class="btn playGameBtn">
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
