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
    #confirmPicksBtn:hover{
        background-color: #52a03d!important;
    }
    #clearPicksBtn:hover{
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

    <div class="picksTable">
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
            <div class="picksBtns text-center" style="display:none;padding-top: 45px;clear: both">
                <form id="selectionsForm" method="POST" action="{{ action('SelectionsController@store') }}">
                    {!! csrf_field() !!}
                    <button id="confirmPicksBtn" style="min-width: 220px;background-color:#58af42;border-color:darkgreen;" class="btn btn-lg gameBtn" type="submit">Confirm Picks</button>
                    <a id="clearPicksBtn" style="min-width: 220px;background-color:#db3125;border-color:darkred;" class="btn btn-lg gameBtn clearPicks">Clear Picks</a>
                </form>
            </div>

            <div>
                <button style="display:none" id="showNoFunds" href="#showNoFundsModal" data-toggle="modal"></button>
                @include('partials.showNoFunds')
            </div>

        @else <!-- Show past game results -->
            @include('partials.pastGameResults')
        @endif
    </div>

    <script src="/vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript">
        // Square Selection
        function hasFunds(){
            return getEndBalance() >= {{$pickCost}};
        }

        function getEndBalance(){
            var numberOfPicksSelected = $(".picksTable table tr td.pendingPick").length;
            var pickCost = {{$pickCost}};
            var toBePaid = numberOfPicksSelected * pickCost;
            var beginningBalance = {{$userCredit}};
            var endBalance = beginningBalance - toBePaid;
            return endBalance;
        };

        function creditCheck(){
            if (hasFunds()) {
                return true;
            }
            $('#showNoFunds').trigger('click');
            return false;
        };

        function changeCreditBalance(){
            var endBalance = getEndBalance();
            $('#creditBalance').text('$' + endBalance.toFixed(2));
            setBalanceColor();
        };

        function setBalanceColor() {
            if (hasFunds()) {
                $('#creditBalance').css('color', 'lightgrey');
            } else {
                $('#creditBalance').css('color', 'red');
            }
        }
        setBalanceColor();

        function togglePicksBtns(){
            var hasPendingPicks = $(".picksTable table tr td").hasClass("pendingPick");
            if (hasPendingPicks) {
                $(".picksBtns").fadeIn(250);
                if ($(".picksTable table tr td.pendingPick").length == 1) {
                    $("#confirmPicksBtn").text("Confirm Pick");
                    $("#clearPicksBtn").text("Clear Pick");
                } else {
                    $("#confirmPicksBtn").text("Confirm Picks");
                    $("#clearPicksBtn").text("Clear Picks");
                }
            } else {
                $(".picksBtns").fadeOut(250);
            }
        };

        $(".availableSquare").on('click', function(e){
            if ($(this).hasClass('pendingPick') || creditCheck()) {
                $(this).toggleClass('pendingPick');
                $(this).find('i').toggleClass('fa-check');
            }
            changeCreditBalance();
            togglePicksBtns();
        });

        $('#confirmPicksBtn').on('click', function(){
            var pendingPicks = $(".picksTable table tr td.pendingPick");
            if (pendingPicks.length < 1) {
                return false;
            } else {
                var gameId = {{$thisGame[0]['id']}};
                var gameIdInput = "<input type=hidden name=game_id value="+gameId+">";
                $("#selectionsForm").append(gameIdInput);

                pendingPicks.each(function(){
                    var selection = $(this).data("id");
                    var selectionInput = "<input id="+selection+" type=hidden name=selection["+selection+"] value="+selection+" class=selection>";
                    $("#selectionsForm").append(selectionInput);
                });

                $(".picksTable").addClass('submittingPicks');
                $('#selectionsForm').submit();
            }
        });

        $('#selectionsForm').submit(function() {
            var selections = $('#selectionsForm').find('input.selection');
            selections.each(function(){
                var selection = $(this).attr('id');
                var pickSquare = $(".picksTable table tr td[data-id="+selection+"]");
                if (pickSquare.hasClass('pendingPick')) {
                    return true;
                } else {
                    $("#selectionsForm").find("input#"+selection+"").remove();
                }
            });
            return true;
        });

        $('#clearPicksBtn').on('click', function(){
            $availSquares = $(".picksTable").find(".availableSquare");
            $availSquares.removeClass('pendingPick');
            $availSquares.find('i').removeClass('fa-check');
            $availSquares.css('background','linear-gradient(#333, #222)');
            changeCreditBalance();
            togglePicksBtns();
        });

        $(window).on('beforeunload', function () {
            if ($('.pendingPick').length && !$('.submittingPicks').length) {
                return 'Would you like to stay and confirm your pending picks?';
            }
        });
    </script>
@stop
