
    <div id="picksTable" class="picksTable">
        @if (!$gameOver && !$gameCancel) <!-- Show game table for current/future games -->
            <!-- CREDIT BALANCE -->
            <div class="col-xs-12 text-center fc-grey showOnMobile">
                <h3 class="margin-0 fs-16">
                    Credit Balance:
                    <span class="{{ $credit <= 0 ? 'fc-red' : 'fc-green'}} creditBalance" id="creditBalance" data-balance="{{$credit}}">
                        {{$creditAmount}}
                    </span>
                </h3>
            </div>

            <!-- SQUARES GAME TABLE -->
            <div class="col-xs-12">
                @include('game.gameTable')
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
                @include('game.modals.chooseAnotherGameModal')
            </div>

            <!-- NO FUNDS MODAL BUTTON (HIDDEN) -->
            <div class="noFunds">
                <button style="display:none" id="showNoFunds" href="#showNoFundsModal" data-toggle="modal"></button>
                @include('payments.showNoFunds')
            </div>

            @include('game.modals.deletePickModal')

        @elseif($gameOver)
            @include('game.pastGameResults')
        @else
            @include('game.gameCancel')
        @endif

        @include('game.modals.gameDetailsModal')
        @include('game.modals.gameStartedModal')
    </div>
