<!-- HOME TEAM NAME -->
<div class="col-xs-12 homeTeamName clear">
    <!-- <div class="text-center homeTeamTop fc-white margin-bottom-5">
        (Top of the table)
    </div> -->
    <h1 class="text-center margin-top-0 fc-white margin-bottom-0 outline-text">
        {{$homeTeam}}
        @if($homeLogo != 'TBD')
            <img src="/img/team_logos/{{$homeLogo}}" width="40" height="35">
        @endif
    </h1>
</div>

<table id="gameTable" class="table table-bordered margin-bottom-0 noBorder transparent">
    <colgroup>
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
    </colgroup>
    <tr>
        <td rowspan="12" class="uppercase bold fs-25 hideAwayTeam noBorder cursor-arrow outline-text">
            <div class="verticalTeamName">
                {{$awayTeam}}
                @if($awayLogo != 'TBD')
                    <img src="/img/team_logos/{{$awayLogo}}" width="40" height="35">
                @endif
            </div>
        </td>
        <td colspan="11" class="text-center uppercase bold fs-25 padding-5 hideHomeTeam noBorder transparent cursor-arrow outline-text">
            {{$homeTeam}}
            @if($homeLogo != 'TBD')
                <img src="/img/team_logos/{{$homeLogo}}" width="40" height="35">
            @endif
        </td>
    </tr>
    <tr class="transparent">
        <th class="gameTableHeader">
            <a class="fc-black" href="#gameDetails" data-toggle="modal" title="View Game/Pot Details">
                <i class="fas fa-info-circle fs-20"></i>
            </a>
        </th>
        <!-- Creates numbers 0-9 going across -->
        @for ($column = 0; $column < 10; $column++)
            <th class="gameTableHeader {{$gameOver && (($gameStarted == 'true'? $randomNumbers['home'][$column]: '?') == $homeScoreDigit) ? 'winningScore' : ''}}">{{ $gameStarted == 'true'? $randomNumbers['home'][$column]: '?'}}</th>
        @endfor
        <td class="hideGameTableColumn noBorder cursor-arrow"></td>
    </tr>

    <!-- Creates numbers 0-9 going down -->
    @for ($row = 0; $row < 10; $row++)
        <tr class="transparent">
            <th class="gameTableHeader {{$gameOver && (($gameStarted == 'true'? $randomNumbers['away'][$row]: '?') == $awayScoreDigit) ? 'winningScore' : ''}}">{{ $gameStarted == 'true'? $randomNumbers['away'][$row]: '?'}}</th>
            <!-- Creates all 100 squares on the table -->
            @for ($column = 0; $column < 10; $column++)
                <?php
                    $squareId = $gameStarted == 'true' ? $randomNumbers['home'][$column].$randomNumbers['away'][$row] : '?';
                    $isWinningSquare = $gameOver == 'true' ? ($winningSelection == $squareId) : '';
                ?>
                @if (in_array("$column$row", $thisGameSelections))
                    @foreach($squaresSelected as $user)
                        @if($user->square_selection == $column.$row)
                            <td class="notAvailable text-center middle padding-0 {{ $isWinningSquare ? 'thickLimeGreenBorder' : '' }}" data-id="{{$column}}{{$row}}" data-user-id="{{$user->id}}" data-username="{{$user->username}}" data-square-id="{{$squareId}}" style="background-image: url('/img/profilePics/{{$user->avatar}}');background-size: cover;background-color:#111">
                                @if($user->id != Auth::id() || $gameOver)
                                    <a data-role-ajax="{{action('AccountController@show', [$user->id])}}" <?= $user->id != Auth::id() ? "title=\"View $user->username's Profile\"" : "" ?> style="cursor:pointer">
                                        <div class='showUserContainer'>
                                            <div class='showUserBG'></div>
                                                <small class="hideOnMobile"><span class='showUserName margin-top-10 inline-block'></span></small>
                                        </div>
                                    </a>
                                @endif
                            </td>
                        @endif
                    @endforeach
                @else
                    <td class="middle availableSquare text-center padding-0 {{ $isWinningSquare ? 'thickLimeGreenBorder' : '' }}" data-id="{{$column}}{{$row}}" data-square-id="{{$squareId}}"><i class="fc-green fas"></i></td>
                @endif
            @endfor
            <td class="hideGameTableColumn noBorder cursor-arrow"></td>
        </tr>
    @endfor
</table>

<!-- AWAY TEAM NAME FOR MOBILE, TABLET (shows below the table) -->
<div class="col-xs-12 awayTeamName fc-white clear">
    <h1 class="text-center margin-bottom-0 margin-top-5 outline-text">
        {{$awayTeam}}
        @if($awayLogo != 'TBD')
            <img src="/img/team_logos/{{$awayLogo}}" width="40" height="35">
        @endif
    </h1>
    <div class="text-center fc-white">
        (Left side of the table)
    </div>
</div>

<?php
    $notStarted = $gameStarted == 'false';
?>
@if($notStarted)
    <div class="fc-grey text-right margin-top-5" style="margin-right:90px">
        Picks Available: <span class="counter inline-block fc-yellow text-left" style="width:20px"></span>
    </div>
@endif

<!-- <script src="/vendor/jquery/jquery.min.js"></script> -->
<script type="text/javascript">
    // Square Selection JS
    $this = $('#gameTable');

    function updateCounter(){
        var picks = $this.find(".notAvailable, .pendingPick").length;
        var picksLeft = 100 - picks;
        if (picksLeft == 0) {
            $(".counter").addClass("fc-red");
            $(".counter").removeClass("fc-yellow");
        } else {
            $(".counter").removeClass("fc-red");
            $(".counter").addClass("fc-yellow");
        }
        $(".counter").html(picksLeft);
    }
    updateCounter();

    function hasFunds(){
        return getEndBalance() >= {{$pickCost}};
    }

    function getEndBalance(){
        var numberOfPicksSelected = $this.find("td.pendingPick").length;
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
        var pendingPicks = $this.find("td.pendingPick").length,
            hasPendingPicks = pendingPicks > 0,
            hasMultiPicks = pendingPicks > 1,
            picks = hasMultiPicks ? "Picks" : "Pick";

        if (hasPendingPicks) {
            $(".picksBtns").fadeIn(250);
            $("#confirmPicksBtn").text("Confirm " + picks);
            $("#clearPicksBtn").text("Clear " + picks);
        } else {
            $(".picksBtns").fadeOut(250);
        }
    };

    function updatePotAmounts() {
        var numberOfPicksSelected = $this.find("td.pendingPick").length,
            pickCost = {{$pickCost}},
            moneySpent = numberOfPicksSelected * pickCost,
            moneyInGameAmount = "{{$moneyInGame}}",
            potAmount = "{{$potAmount}}",
            moneyInGame = parseInt(moneyInGameAmount.substr(1)),
            pot = parseInt(potAmount.substr(1)),
            updatedMoneyInGame = moneyInGame + moneySpent,
            updatedPot = pot + moneySpent;

        $('#moneyInGame').text('$' + updatedMoneyInGame.toFixed(2));
        $('#pot').text('$' + updatedPot.toFixed(2));
    }


    // For pick selection
    $this.find(".availableSquare").on('click', function(e){
        if ({{$gameStarted}} || {{$isOver}}) {
            if ({{$gameStarted}}) {
                $('#gameStartedModal').modal();
            }
            return false;
        }

        if ($(this).hasClass('pendingPick') || creditCheck()) {
            $(this).toggleClass('pendingPick');
            $(this).find('i').toggleClass('fa-check');
        }
        changeCreditBalance();
        togglePicksBtns();
        updatePotAmounts();
        updateCounter();
    });
    // Submit Picks
    $('#selectionsForm').on('submit', function(e) {
        e.preventDefault();

        var selections = $this.find('#selectionsForm').find('input.selection');
        selections.each(function(){
            var selection = $(this).attr('id');
            var pickSquare = $this.find("td[data-id="+selection+"]");
            if (pickSquare.hasClass('pendingPick')) {
                return true;
            } else {
                $("#selectionsForm").find("input#"+selection+"").remove();
            }
        });

        var gameId = $(this).find('input[name=game_id]').val();
        $(this).postForm({
            url: "/selections",
            reload: "/play/"+gameId+"",
            makingPicks: true,
            forceReload: true
        });
    });


    // For pick deletion
    $this.find('.notAvailable[data-user-id='+{{Auth::id()}}+']').each(function() {
        if ({{$gameStarted}}) {
            return false;
        }

        var id = $(this).data('id');
        var deletePick = "";
        deletePick += "<a data-id='"+id+"' class='deletePick' href='#deletePickModal' data-toggle='modal'>";
        deletePick += "<div class='deletePickContainer'>";
        deletePick += "<div class='deletePickBG'></div>";
        deletePick += "<i class='fs-16 margin-top-10 fc-red fas'></i>";
        deletePick += "</div></a>";
        $(this).append(deletePick);
    });
    $this.find(".availableSquare").on('mouseout mouseover', function(e){
        var gradientStart = '';
        if (!$(this).hasClass('pendingPick')) {
            gradientStart = (e.type == 'mouseout') ? '#333' : '#111';
            $(this).css('background','linear-gradient(' + gradientStart + ', #222)');
        }
    });
    if (!{{$isOver}}) {
        $this.find('.notAvailable').on('mouseover mouseout', function(e){
        var isLoggedInUser = $(this).data('user-id') == {{Auth::id()}};

        if (isLoggedInUser)
        {
            if ({{$gameStarted}}) {
                return false;
            }

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
                $(this).find('.showUserName').text($(this).data('username'));
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
    }
    // set pick to delete
    $this.find('.deletePick').click(function(e){
        if ({{$gameStarted}}) {
            return false;
        }
        $(this).addClass('deleting');
    });
    // Confirm Deletion
    $('#deletePickBtn').on('click', function(){
        if ({{$gameStarted}}) {
            return false;
        }

        var pickToDelete = $this.find(".deleting");
        if (pickToDelete.length != 1) {
            return false;
        } else {
            var gameId = {{$gameId}};
            var gameIdInput = "<input type=hidden name=game_id value="+gameId+">";
            $("#deletePickForm").append(gameIdInput);

            pickToDelete.each(function(){
                var selection = $(this).data("id");
                var selectionInput = "<input id="+selection+" type=hidden name=selection value="+selection+" class=pickToDelete>";
                $("#deletePickForm").append(selectionInput);
            });
        }
    });
    // Submit Deletion of picks
    $('#deletePickForm').on('submit', function(e) {
        e.preventDefault();
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

        var gameId = $(this).find('input[name=game_id]').val();
        $(this).postForm({
            url: "{{ action('SelectionsController@destroy') }}",
            reload: "/play/"+gameId+"",
            forceReload: true,
        });
    });


    // Confirm Picks
    $('#confirmPicksBtn').on('click', function(){
        var pendingPicks = $this.find("td.pendingPick");
        if (pendingPicks.length < 1 || pendingPicks.length > {{$userCredit}}/{{$pickCost}} ) {
            return false;
        } else {
            var gameId = {{$gameId}};
            var gameIdInput = "<input type=hidden name=game_id value="+gameId+">";
            $("#selectionsForm").append(gameIdInput);

            pendingPicks.each(function(){
                var selection = $(this).data("id");
                var selectionInput = "<input id="+selection+" type=hidden name=selection["+selection+"] value="+selection+" class=selection>";
                $("#selectionsForm").append(selectionInput);
            });

            $this.addClass('submittingPicks');
        }
    });
    // Clear Picks
    $('#clearPicksBtn').on('click', function(){
        $availSquares = $this.find(".availableSquare");
        $availSquares.removeClass('pendingPick');
        $availSquares.find('i').removeClass('fa-check');
        $availSquares.css('background','linear-gradient(#333, #222)');
        changeCreditBalance();
        togglePicksBtns();
        updatePotAmounts();
        updateCounter();
    });


    // Ask user to confirm pending picks when navigating away from page
    if ({{$gameStarted}} != true) {
        $(window).on('beforeunload', function () {
            if ($('.pendingPick').length && !$('.submittingPicks').length) {
                return 'Would you like to stay and confirm your pending picks?';
            }
        });
    }


    if ({{$isOver}}) {
        $squares = $this.find('td').not('.thickLimeGreenBorder');
        $squares.on('mouseover mouseout', function(e){
            if (e.type == 'mouseover') {
                var isLoggedInUser = $(this).data('user-id') == {{Auth::id()}};
                if (isLoggedInUser) {
                    return false;
                }

                $(this).find('.showUserName').text($(this).data('username'));
            } else {
                $(this).find('.showUserName').text('');
            }
        });
        $squares.find('.showUserContainer')
        .css({
            'position': 'relative',
            'z-index': '1',
            'min-height': '36px'
        });
        $squares.find('.showUserBG')
        .css({
            'position': 'absolute',
            'z-index': '-1',
            'background': '#000',
            'opacity': '.65',
            'width': '100%',
            'height': '100%'
        });
    }
</script>
