<div class="text-center">
    @if($hasWinnings)
        <div class="margin-top-20">
            <div class="fc-yellow fs-16">Total Winnings:</div>
            <div class="fc-grey">
                <h3 class="margin-0">{{$totalWinnings}}</h3>
            </div>
            <div class="margin-top-5">
                <button data-role-ajaxsection="/winningGames" class="btn btn-xs">See Wins</button>
            </div>
        </div>
    @endif

    <div data-ajax-load="/favTeam">
        @include('account.partials.favTeam')
    </div>
</div>
