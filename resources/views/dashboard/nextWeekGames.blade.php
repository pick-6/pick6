<?php
$includeTitle =  $includeTitle ?? true;
$showTitle = $includeTitle == 'true' ? true : false;
?>

@if($showTitle)
    <h3 class="fc-white">{{$nextWeekGamesTitle ?? $title}}</h3>
@endif

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
