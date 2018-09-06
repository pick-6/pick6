<h3 class="fc-white">Next Week's Games</h3>

@if ($hasNextWeekGames)
    @include('game.list', [
        'games' => $nextWeekGames,
        'dates' => $datesOfNextWeekGames,
        'showGameTime' => false,
        'showPicksAvail' => false,
        'showPlayGameBtn' => false,
        'isNextWeekList' => true
    ])
@else
    <p class="noGames margin-0-auto fc-grey margin-top-50" style="font-size: 1.5em;">
        No upcoming games next week.
    </p>
@endif
