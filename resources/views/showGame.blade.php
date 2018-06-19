<?php
use App\User;
function getCredit($userId){
    $creditForUser = User::select('credit')->where('id', '=', $userId)->get();
    return $creditForUser[0]['credit'];
}
function creditCheck(){

}
?>
@extends('layouts.master')
@section('content')
<style>
    td:not(.notAvailable):hover{
        cursor: pointer;
    }
    .awayTeamNameDesktop {
        margin: 0px!important;
        width: 375px!important;
        left: -40px!important;
        position: absolute!important;
        top: 180px!important;
        display: block;
        color: white;
        /*text-align: left;*/
        transform: rotate(-90deg);
        transform-origin: center;
        /*margin-top: 40%*/
    }
    @media(min-width: 1500px){
        .picksTable {
            /* width: 75% */
        }
    }
    /* @media(max-width: 1200px){
        .container {
            margin: 0px;
        }
    } */
    @media(max-width: 1200px){
        .container {
            width: 100%;
        }
    }
    @media(max-width: 992px){
        .awayTeamNameDesktop {
            display: none;
        }
        .awayTeamName {
            display: block;
        }
    }
    @media(min-width: 992px){
        .awayTeamNameDesktop {
            display: block;
        }
        .awayTeamName {
            display: none;
        }
    }
    .confirmPicksBtn button:hover{
        background-color: #52a03d!important;
    }
    .confirmPicksBtn a:hover{
        background-color: #cc2b22!important;
    }
    @media(max-width: 477px){
        .clearPicks {
            margin-top: 20px;
        }
    }
    @media(max-width: 498px){
        .clearPicks {
            margin-left: 0px;
        }
    }
    @media(min-width: 498px){
        .clearPicks {
            margin-left: 20px;
        }
    }
</style>
    <div class="picksTable showGamePage activeSection" style="display:none">
        @if ($thisGame[0]['week'] >= $currentWeek) <!-- Show game table for future games -->
            <!-- HOME TEAM NAME -->
            <div class="col-sm-12 homeTeamName" style="margin-top: 0px">
                <h1 class="text-center">{{$thisGame[0]['home']}}
                    <img src="/img/team_logos/{{$thisGame[0]['home_logo']}}" width="40" height="35">
                </h1>
                <p class="text-center homeTeamTop">(Top of the table)</p>
            </div>

            <!-- AWAY TEAM NAME FOR DESKTOP (shows on the left side of the table) -->
            <div class="col-md-2">
                <h1 class="text-center awayTeamNameDesktop">{{$thisGame[0]['away']}}
                    <img src="/img/team_logos/{{$thisGame[0]['away_logo']}}" width="40" height="35">
                </h1>
            </div>

            <!-- SQUARES GAME TABLE -->
            <div class="col-sm-12 col-md-8" style="padding:0px">
                <table class="table table-bordered" style="margin-bottom: 0px">
                    <colgroup>
                        <col style="width:75px"/>
                        <col style="width:75px"/>
                        <col style="width:75px"/>
                        <col style="width:75px"/>
                        <col style="width:75px"/>
                        <col style="width:75px"/>
                        <col style="width:75px"/>
                        <col style="width:75px"/>
                        <col style="width:75px"/>
                        <col style="width:75px"/>
                        <col style="width:75px"/>
                    </colgroup>
                    <tr>
                        <th style="border-color: black;background: linear-gradient(#ffce7a,#FEC503)"></th>
                        <!-- Creates numbers 0-9 going across -->
                        @for ($column = 0; $column < 10; $column++)
                            <th style="border-color: black;text-align: center;background: linear-gradient(#ffce7a,#FEC503)">{{ $gameOver? $randomNumbers['home'][$column]: '?'}}<!-- {{$column}} --></th>
                        @endfor
                    </tr>

                    <!-- Creates numbers 0-9 going down -->
                    @for ($row = 0; $row < 10; $row++)
                        <tr>
                            <th style="border-color: black;text-align: center;background: linear-gradient(#ffce7a,#FEC503)">{{ $gameOver? $randomNumbers['away'][$row]: '?'}}<!-- {{$row}} --></th>
                            <!-- Creates all 100 squares on the table -->
                            @for ($column = 0; $column < 10; $column++)
                                @if (in_array("$column$row", $thisGameSelections))
                                    @foreach($squaresSelected as $user)
                                        @if($user->square_selection == $column.$row)
                                            <td class="notAvailable text-center middle" data-id="{{$column}}{{$row}}" style="padding: 0px;background-image: url('/img/profilePics/{{$user->avatar}}');background-size: cover;"></td>
                                        @endif
                                    @endforeach
                                @else
                                    <td style="padding:0px;" class="middle availableSquare text-center" data-id="{{$column}}{{$row}}"><i class="fas" style="color:green;"></i></td>
                                @endif
                            @endfor
                        </tr>
                    @endfor
                </table>
            </div>

            <!-- AWAY TEAM NAME FOR MOBILE, TABLET (shows below the table) -->
            <div class="col-sm-12 awayTeamName">
                <h1 class="text-center">{{$thisGame[0]['away']}}<img src="/img/team_logos/{{$thisGame[0]['away_logo']}}" width="40" height="35"></h1>
                <p class="text-center">(Left side of the table)</p>
            </div>

            <!-- CHOOSE ANOTHER GAME -->
            <div class="text-center" style="padding-top: 45px;clear: both;">
                <button href="#chooseAnotherGame" data-toggle="modal" style="color: #000; text-transform: uppercase;" class="btn btn-lg gameBtn">Choose Another Game</button>
                @include('partials.chooseAnotherGameModal')
            </div>

            <!-- CONFIRM PICKS SELECTED -->
            <div class="confirmPicksBtn text-center" style="display:none;padding-top: 45px;clear: both">
                <form  method="POST" action="{{ action('SelectionsController@store') }}">
                    {!! csrf_field() !!}
                    <input type=hidden name="user_id" value= "{{ Auth::user()->id }}">
                    <input type=hidden name="game_id" value="{{$thisGame[0]['id']}}">
                    <button style="min-width: 220px;background-color:#58af42;border-color:darkgreen;" class="btn btn-lg gameBtn" type="submit">Confirm Picks</button>
                    <a style="min-width: 220px;background-color:#db3125;border-color:darkred;" class="btn btn-lg gameBtn clearPicks">Clear Picks</a>
                </form>
            </div>

        @else <!-- Show past game results -->
            @include('partials.pastGameResults')
        @endif
    </div>
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript">
    // Square Selection
    $(".availableSquare").on('click', function(e){
        if ($(this).hasClass('pendingPick')) {
            $(this).toggleClass('pendingPick');
            $(this).find('i').toggleClass('fa-check');
            var selection = $(this).data('id');
            var notPending = !$(this).hasClass('pendingPick');
            if (notPending)
            {
                $(".picksTable").find(".confirmPicksBtn form input#"+selection+"").remove();
            }
            else
            {
                var input = "<input id="+selection+" type=hidden name=selection["+selection+"] value="+selection+" class=selection>";
                $(".picksTable").find(".confirmPicksBtn form").append(input);
            }
        }
        else if (creditCheck()) {
            $(this).toggleClass('pendingPick');
            $(this).find('i').toggleClass('fa-check');

            var selection = $(this).data('id');
            var notPending = !$(this).hasClass('pendingPick');
            if (notPending)
            {
                $(".picksTable").find(".confirmPicksBtn form input#"+selection+"").remove();
            }
            else
            {
                var input = "<input id="+selection+" type=hidden name=selection["+selection+"] value="+selection+" class=selection>";
                $(".picksTable").find(".confirmPicksBtn form").append(input);
            }
        }
        changeCreditBalance();
        toggleConfirmPicksBtn();
    });

    $('.clearPicks').on('click', function(){
        $(".picksTable").find(".confirmPicksBtn form input.selection").remove();
        $(".picksTable").find(".availableSquare").removeClass('pendingPick');
        $(".picksTable").find(".availableSquare").find('i').removeClass('fa-check');
        $(".picksTable").find(".availableSquare").css('background','linear-gradient(#333, #222)');
        toggleConfirmPicksBtn();
        changeCreditBalance();
    });

    function toggleConfirmPicksBtn(){
        if ($(".picksTable table tr td").hasClass("pendingPick")) {
            $(".confirmPicksBtn").fadeIn(250);
            if ($(".picksTable table tr td.pendingPick").length == 1) {
                $(".confirmPicksBtn button").text("Confirm Pick");
                $(".confirmPicksBtn a").text("Clear Pick");
            } else {
                $(".confirmPicksBtn button").text("Confirm Picks");
                $(".confirmPicksBtn a").text("Clear Picks");
            }
        } else {
            $(".confirmPicksBtn").fadeOut(250);
        }
    };

    function changeCreditBalance(){
        var endBalance = getEndBalance();
        $('#creditBalance').text(endBalance + ".00");
    };

    function creditCheck(){
        var endBalance = getEndBalance();
        if (endBalance <= 0) {
            alert("no funds");
            return false;
        }
        return true;
    };

    function getEndBalance(){
        var numberOfPicksSelected = $(".picksTable table tr td.pendingPick").length;
        var pickCost = 2;
        var toBePaid = numberOfPicksSelected * pickCost;
        var beginningBalance = {{getCredit(Auth::user()->id)}};
        var endBalance = beginningBalance - toBePaid;
        return endBalance;
    };
    </script>
@stop
