<h3 class="fc-white">
    @if($isPreSeason)
        <span class="fc-yellow">Preseason</span> Games - Week {{$currentWeek}}
    @elseif ($isPostSeason)
        <!-- WILD CARD WEEKEND -->
        <!-- DIVISIONAL PLAYOFFS -->
        <!-- CONFERENCE CHAMPIONSHIPS -->
        <!-- PRO BOWL -->
        <!-- SUPER BOWL -->
    @else
        Games for Week {{$currentWeek}}
    @endif
</h3>

@if ($hasGamesForWeek)
    @include('game.gamesForWeekList')
    <div class="time text-left margin-top-5">
        <small>* All times are in Eastern Time (ET)</small>
    </div>
@else
    <p class="noGames margin-0-auto fc-grey margin-top-50" style="font-size: 1.5em;">
        There are no games this week.
    </p>
@endif
