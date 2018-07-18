<?php
use App\User;
?>
@extends('layouts.master')
@section('content')
    <div id="picksTable" class="picksTable">
        @if ($thisGame[0]['week'] >= $currentWeek) <!-- Show game table for current/future games -->
            <!-- CREDIT BALANCE -->
            <?php
                $creditForUser = User::select('credit')->where('id', '=', Auth::user()->id)->get();
                $credit = $creditForUser[0]['credit'];
                $creditAmount = money_format('$%i', $credit);
            ?>
            <div class="col-xs-12 text-center fc-grey showOnMobile">
                <h3 class="margin-top-0 margin-bottom-20">Credit Balance: <span class="{{ $credit <= 0 ? 'fc-red' : 'fc-green'}} creditBalance" id="creditBalance" data-balance="{{$credit}}">{{$creditAmount}}</span></h3>
            </div>

            <!-- HOME TEAM NAME -->
            <div class="col-sm-12 homeTeamName">
                <h1 class="text-center margin-top-0 fc-white margin-bottom-0">{{$thisGame[0]['home']}}
                    <img src="/img/team_logos/{{$thisGame[0]['home_logo']}}" width="40" height="35">
                </h1>
                <div class="text-center homeTeamTop fc-white margin-bottom-5">(Top of the table)</div>
            </div>

            <!-- AWAY TEAM NAME FOR DESKTOP (shows on the left side of the table) -->
            <div class="col-md-2">
                <h1 class="text-center awayTeamNameDesktop">{{$thisGame[0]['away']}}
                    <img src="/img/team_logos/{{$thisGame[0]['away_logo']}}" width="40" height="35">
                </h1>
            </div>

            <!-- SQUARES GAME TABLE -->
            <div class="col-sm-12 col-md-10 col-lg-8 padding-0">
                @include('game.gameTable')
            </div>

            <!-- AWAY TEAM NAME FOR MOBILE, TABLET (shows below the table) -->
            <div class="col-sm-12 awayTeamName fc-white">
                <h1 class="text-center margin-bottom-0 margin-top-5">{{$thisGame[0]['away']}}<img src="/img/team_logos/{{$thisGame[0]['away_logo']}}" width="40" height="35"></h1>
                <div class="text-center fc-white">(Left side of the table)</div>
            </div>

            <!-- CONFIRM PICKS SELECTED -->
            <div class="picksBtns text-center clear margin-top-10" style="display:none;">
                <form id="selectionsForm" method="POST" action="{{ action('SelectionsController@store') }}">
                    {!! csrf_field() !!}
                    <div class="col-xs-6 text-right">
                        <button id="confirmPicksBtn" class="btn btn-lg gameBtn" type="submit">Confirm Picks</button>
                    </div>
                    <div class="col-xs-6 text-left">
                        <a id="clearPicksBtn" class="btn btn-lg gameBtn clearPicks">Clear Picks</a>
                    </div>
                </form>
            </div>

            <!-- CHOOSE ANOTHER GAME -->
            <div class="text-center clear" style="padding-top: 30px;">
                <button href="#chooseAnotherGame" data-toggle="modal" class="btn btn-lg gameBtn">Join Another Game</button>
                @include('game.chooseAnotherGameModal')
            </div>

            <!-- NO FUNDS MODAL BUTTON (HIDDEN) -->
            <div class="noFunds">
                <button style="display:none" id="showNoFunds" href="#showNoFundsModal" data-toggle="modal"></button>
                @include('payments.showNoFunds')
            </div>

            @include('game.deletePickModal')

        @else <!-- Show past game results -->
            @include('game.pastGameResults')
        @endif

        @include('game.gameDetailsModal')
    </div>

    <script src="/vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript">
        // Square Selection JS
        $this = $('#picksTable');

        function hasFunds(){
            return getEndBalance() >= {{$pickCost}};
        }

        function getEndBalance(){
            var numberOfPicksSelected = $this.find("table tr td.pendingPick").length;
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
            $this.find('#showNoFunds').trigger('click');
            return false;
        };

        function changeCreditBalance(){
            var endBalance = getEndBalance();
            $('.creditBalance').text('$' + endBalance.toFixed(2));
            setBalanceColor();
        };

        function setBalanceColor() {
            if (hasFunds()) {
                $('.creditBalance').removeClass('fc-red');
                $('.creditBalance').removeClass('fc-green');
                $('.creditBalance').addClass('fc-green');
            } else {
                $('.creditBalance').removeClass('fc-green');
                $('.creditBalance').removeClass('fc-red');
                $('.creditBalance').addClass('fc-red');
            }
        }
        setBalanceColor();

        function togglePicksBtns(){
            var hasPendingPicks = $this.find("table tr td").hasClass("pendingPick");
            if (hasPendingPicks) {
                $(".picksBtns").fadeIn(250);
                if ($this.find("table tr td.pendingPick").length == 1) {
                    $this.find("#confirmPicksBtn").text("Confirm Pick");
                    $this.find("#clearPicksBtn").text("Clear Pick");
                } else {
                    $this.find("#confirmPicksBtn").text("Confirm Picks");
                    $this.find("#clearPicksBtn").text("Clear Picks");
                }
            } else {
                $this.find(".picksBtns").fadeOut(250);
            }
        };

        function updatePotAmounts() {
            var numberOfPicksSelected = $this.find("table tr td.pendingPick").length;
            var pickCost = {{$pickCost}};
            var moneySpent = numberOfPicksSelected * pickCost;
            var moneyInGameAmount = "{{$moneyInGame}}";
            var potAmount = "{{$potAmount}}";
            var moneyInGame = parseInt(moneyInGameAmount.substr(1));
            var pot = parseInt(potAmount.substr(1));
            var updatedMoneyInGame = moneyInGame + moneySpent;
            var updatedPot = pot + moneySpent;
            $('#moneyInGame').text('$' + updatedMoneyInGame.toFixed(2));
            $('#pot').text('$' + updatedPot.toFixed(2));
        }


        // For pick selection
        $this.find(".availableSquare").on('click', function(e){
            if ($(this).hasClass('pendingPick') || creditCheck()) {
                $(this).toggleClass('pendingPick');
                $(this).find('i').toggleClass('fa-check');
            }
            changeCreditBalance();
            togglePicksBtns();
            updatePotAmounts();
        });

        $this.find('#confirmPicksBtn').on('click', function(){
            var pendingPicks = $this.find("table tr td.pendingPick");
            if (pendingPicks.length < 1 || pendingPicks.length > {{$userCredit}}/{{$pickCost}} ) {
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

                $this.addClass('submittingPicks');
                $this.find('#selectionsForm').submit();
            }
        });

        $this.find('#selectionsForm').submit(function() {
            var selections = $this.find('#selectionsForm').find('input.selection');
            selections.each(function(){
                var selection = $(this).attr('id');
                var pickSquare = $this.find("table tr td[data-id="+selection+"]");
                if (pickSquare.hasClass('pendingPick')) {
                    return true;
                } else {
                    $this.find("#selectionsForm").find("input#"+selection+"").remove();
                }
            });
            return true;
        });

        $this.find('#clearPicksBtn').on('click', function(){
            $availSquares = $this.find(".availableSquare");
            $availSquares.removeClass('pendingPick');
            $availSquares.find('i').removeClass('fa-check');
            $availSquares.css('background','linear-gradient(#333, #222)');
            changeCreditBalance();
            togglePicksBtns();
            updatePotAmounts();
        });


        // Ask user to confirm pending picks when navigating away from page
        $(window).on('beforeunload', function () {
            if ($('.pendingPick').length && !$('.submittingPicks').length) {
                return 'Would you like to stay and confirm your pending picks?';
            }
        });


        // For pick deletion
        $this.find('.notAvailable[data-user='+{{Auth::user()->id}}+']').each(function() {
            var id = $(this).data('id');
            var deletePick = "";
            deletePick += "<a data-id='"+id+"' class='deletePick' href='#deletePickModal' data-toggle='modal'>";
            deletePick += "<div class='deletePickContainer'>";
            deletePick += "<div class='deletePickBG'></div>";
            deletePick += "<i class='fs-16 margin-top-10 fc-red fas'></i>";
            deletePick += "</div></a>";
            $(this).append(deletePick);
        });

        $this.find('.notAvailable').on('mouseover mouseout', function(e){
            var isLoggedInUser = $(this).data('user') == {{Auth::user()->id}};

            if (isLoggedInUser)
            {
                $(this).find('i').toggleClass('fa-times');
                if (e.type == 'mouseover')
                {
                    $(this).find('.deletePickContainer')
                    .css({
                        'position': 'relative',
                        'z-index': '1',
                        'min-height': '36px'
                    });
                    $(this).find('.deletePickBG')
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
                    $(this).find('.deletePickBG')
                    .css({
                        'background': 'initial',
                    });
                }
            }
            else
            {
                if (e.type == 'mouseover')
                {
                    $(this).find('.showUserName').text($(this).data('title'));
                    $(this).find('.showUserContainer')
                    .css({
                        'position': 'relative',
                        'z-index': '1',
                        'min-height': '36px'
                    });
                    $(this).find('.showUserBG')
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
                    $(this).find('.showUserName').text('');
                    $(this).find('.showUserBG')
                    .css({
                        'background': 'initial',
                    });
                }
            }
        });

        $this.find('.deletePick').click(function(e){
            $(this).addClass('deleting');
        });

        $this.find('#deletePickBtn').on('click', function(){
            var pickToDelete = $this.find(".deleting");
            if (pickToDelete.length != 1) {
                return false;
            } else {
                var gameId = {{$thisGame[0]['id']}};
                var gameIdInput = "<input type=hidden name=game_id value="+gameId+">";
                $("#deletePickForm").append(gameIdInput);

                pickToDelete.each(function(){
                    var selection = $(this).data("id");
                    var selectionInput = "<input id="+selection+" type=hidden name=selection value="+selection+" class=pickToDelete>";
                    $("#deletePickForm").append(selectionInput);
                });

                $(this).find('#deletePickForm').submit();
            }
        });

        $this.find('#deletePickForm').submit(function() {
            var picksToDelete = $this.find('#deletePickForm').find('input.pickToDelete');
            picksToDelete.each(function(){
                var pickToDelete = $(this).attr('id');
                var pickSquare = $this.find(".deletePick[data-id="+pickToDelete+"]");
                if (pickSquare.hasClass('deleting')) {
                    return true;
                } else {
                    $this.find("#deletePickForm").find("input#"+pickToDelete+"").remove();
                }
            });
            return true;
        });
    </script>
@stop
