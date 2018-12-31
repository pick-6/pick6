<h3 class="fc-white">
    @if($isPreSeason)
        <span class="fc-yellow">Preseason</span> Games - Week {{$currentWeek}}
    @elseif ($isPostSeason)
        {{$postSeasonTitle}}
    @else
        Games for Week {{$currentWeek}}
    @endif
</h3>

@if ($hasGamesForWeek)
    @include('game.list', ['showGameId'=>true])
@else
    <p class="noGames margin-0-auto fc-grey margin-top-50" style="font-size: 1.5em;">
        There are no games this week.
    </p>
@endif
