<?php
    use \App\Http\Controllers\GamesController;
    use Carbon\Carbon;
?>
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
            <div id="no-more-tables" class="table-responsive userCurrentGames">
                <table class="table table-bordered margin-bottom-0">
                    <colgroup>
                        <col style="width: 10%">
                        <col>
                        <col style="width: 25%">
                    </colgroup>
                    <tbody>
                        @foreach ($currentGames as $game)
                        <?php
                            $numberOfPicks = GamesController::numberOfPicksForGame($game->game_id);
                            $gameTime = $game->date_for_week . ' ' . $game->time;
                            $gameStarted = $gameTime <= Carbon::now('America/New_York');
                            $gameEnded = !is_null($game->home_score) || !is_null($game->away_score);
                            $gameCancel = $numberOfPicks <= 90 && $gameStarted;
                        ?>
                            <tr>
                                @if($gameEnded)
                                    <td class="fs-18 fc-yellow middle text-center padding-5">
                                        FINAL
                                    </td>
                                @else
                                    <td class="gameDayTime" data-title="Kick-Off">
                                        <div class="gamePrice">{{ str_replace(".00","",money_format('$%i',$game->pick_cost)) }}</div>
                                        @if (is_null($game->time))
                                            TBD
                                        @else
                                            {{date("g:i", strtotime("$game->time"))}} <small>{{date("A", strtotime("$game->time"))}}</small>
                                        @endif
                                    </td>
                                @endif
                                <td class="gameTeams text-left padding-10">
                                    <a class="{{$gameEnded ? 'fs-30' : 'fs-16'}}" href="{{action('GamesController@show', [$game->game_id])}}">
                                        <div class="pull-left width50 homeTeam">
                                            <img src="/img/team_logos/{{$game->home_logo}}" height="60" width="65" alt="{{$game->home}}">
                                            <div class="text-left middle {{$gameEnded ? '' : 'width60'}} inline-flex">
                                                {{$gameEnded ? $game->home_score : $game->home}}
                                            </div>
                                        </div>
                                        <div class="pull-right width50">
                                            <img src="/img/team_logos/{{$game->away_logo}}" height="60" width="65" alt="{{$game->away}}">
                                            <div class="text-left middle {{$gameEnded ? '' : 'width60'}} inline-flex">
                                                {{$gameEnded ? $game->away_score : $game->away}}
                                            </div>
                                        </div>
                                    </a>
                                </td>

                                <td id="playGameBtn" class="middle padding-0 padding-b-10">
                                    <a href="{{action('GamesController@show', [$game->game_id])}}" class="btn playGameBtn" style="min-width:85%;">
                                         @if($gameEnded)
                                            SEE RESULTS
                                         @else
                                             @if ($numberOfPicks < 100 && !$gameStarted)
                                                 {{(in_array("$game->game_id", $playingIn)) ? 'GO TO GAME' : 'JOIN GAME'}}
                                             @elseif($gameCancel)
                                                CANCELLED
                                             @else
                                                 SEE GAME
                                             @endif
                                         @endif
                                    </a>
                                    @if(!$gameStarted && !$gameEnded)
                                        <div class="width25 absolute">
                                            <div id="availablePicks">
                                                <div id="availablePicksBar" style="width: {{($numberOfPicks<92)?(100-$numberOfPicks):(($numberOfPicks >= 92 && $numberOfPicks < 100)?8:100)}}%; background-color: <?= ($numberOfPicks <= 40) ? 'green' : (($numberOfPicks <= 65 && $numberOfPicks > 40) ? '#475613' : (($numberOfPicks <= 80 && $numberOfPicks > 65) ? '#923127' : 'crimson'))?>;"></div>
                                            </div>
                                            <div id="availablePicksLabel">
                                                <small>
                                                    <i>
                                                        @if ($numberOfPicks == 100)
                                                            Sorry, Game is Full
                                                        @elseif ($numberOfPicks >= 90 && $numberOfPicks < 100)
                                                            Hurry, only {{100 - $numberOfPicks}} pick{{($numberOfPicks == 99) ? '' : 's'}} left!
                                                        @elseif ($numberOfPicks > 0 && $numberOfPicks < 100)
                                                            {{100 - $numberOfPicks}} Picks Available
                                                        @else
                                                            Be the first to pick!
                                                        @endif
                                                    </i>
                                                </small>
                                            </div>
                                        </div>
                                    @else
                                        <div class="width25 absolute">
                                            <div id="availablePicks">
                                                <div id="availablePicksBar" style="width: 100%; background-color: crimson"></div>
                                            </div>
                                            <div id="availablePicksLabel">
                                                <small>
                                                    <i>
                                                        Game {{$gameEnded ? "Over" : $gameCancel ? "Cancelled" : "Started"}}
                                                    </i>
                                                </small>
                                            </div>
                                        </div>
                                    @endif
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
