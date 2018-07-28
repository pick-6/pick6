<?php
    use \App\Http\Controllers\GamesController;
    use Carbon\Carbon;
?>
@extends('layouts.master')
@section('content')
<style>
    @media(max-width: 991px){
        #accountPage section#accountInfo {
            background: unset!important;
        }
        #accountPage ul {
            max-width: 85%;
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
        height: 594px;
    }
    #accountPage section {
        min-height: 650px;
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
    #accountPage ul li.addCredit {
        border-color: #5cb85c;
    }
    #accountPage ul li.addCredit:hover {
        background-color: #449d44;
        border-color: #449d44;
    }
    #accountPage ul li.editInfo {
        border-color: #0ebeff;
    }
    #accountPage ul li.editInfo:hover {
        background-color: #0ebeff;
        border-color: #0ebeff;
    }
    #accountPage ul li.changePassword {
        border-color: #fed136;
    }
    #accountPage ul li.changePassword:hover {
        background-color: #FEC503;
        border-color: #FEC503;
    }
    #accountPage ul li.deleteAccount {
        border-color: #d9534f;
    }
    #accountPage ul li.deleteAccount:hover {
        background-color: #c9302c;
        border-color: #c9302c;
    }
    #accountPage .showAvatarContainer {
        max-width: 220px;
        height: 220px;
        background-image: url('/img/profilePics/{{$avatar}}');
        background-size: cover;
    }
    #accountPage #accountInfo {
        background-color: #202125;
    }
    #accountPage #currentGames {
        background-color: #181818;
    }
</style>
<div class="text-center" id="accountPage">
    <section id="accountInfo" class="padding-0 col-md-3">
        <div class="padding-10">
            <div class="margin-bottom-10 fc-yellow">
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
            <!-- <div class="text-left">
                <div class="margin-top-5">
                    <div class="fc-yellow inline-block">Winnings:</div>
                    <div class="fc-grey inline-block">$3,000</div>
                </div>
                <div class="margin-top-5">
                    <div class="fc-yellow inline-block">Favorite Team:</div>
                    <div class="fc-grey inline-block">Dallas Cowboys</div>
                </div>
                <div class="margin-top-5">
                    <div class="fc-yellow inline-block" style="width:35px;vertical-align:top">Bio:</div>
                    <div class="fc-grey overflow-auto inline-block" style="height:84px;width:calc(100% - 40px);">
                        This a bio about me. This a bio about me. This a bio about me. This a bio about me. This a bio about me.
                        This a bio about me. This a bio about me. This a bio about me. This a bio about me. This a bio about me. This a bio about me.
                        This a bio about me. This a bio about me.
                    </div>
                </div>
            </div> -->
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
                                    <?php
                                        $gameTime = $game->date_for_week . ' ' . $game->time;
                                        $gameStarted = $gameTime <= Carbon::now('America/New_York');
                                        $gameEnded = !is_null($game->home_score) || !is_null($game->away_score);
                                    ?>
                                     @if($gameEnded)
                                        SEE RESULTS
                                     @else
                                         <?php
                                              $numberOfPicks = GamesController::numberOfPicksForGame($game->id);
                                         ?>
                                         @if ($numberOfPicks < 100 && !$gameStarted)
                                             {{(in_array("$game->game_id", $playingIn)) ? 'GO TO GAME' : 'JOIN GAME'}}
                                         @else
                                             SEE GAME
                                         @endif
                                     @endif
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
