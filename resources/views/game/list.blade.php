<?php
    $isAdmin = Auth::user()->email == 'mattvaldez01@gmail.com';
    $games = $games ?? $gamesForWeek;
    $dates = $dates ?? $datesOfCurrentWeekGames;
    $showGameTime = $showGameTime ?? true;
    $showPicksAvail = $showPicksAvail ?? true;
    $showPlayGameBtn = $showPlayGameBtn ?? true;
    $showTeamName = $showTeamName ?? true;
    $showPrice = $showPrice ?? true;
    $isNextWeekList = $isNextWeekList ?? false;
    $showTimeZone = $showTimeZone ?? $showGameTime ?? false;
    $showGameId = is_null($showGameId ?? null) ? false : $isAdmin;
    $onDash = $onDash ?? false;
?>

<style>
    #currentGames div#no-more-tables {
        max-height: 570px;
        overflow: auto;
    }
</style>

<div id="no-more-tables" class="table-responsive">
    @if(!$dates)
        @include('game.gameListTable')
    @else
        @include('game.gameListTableWithDates')
    @endif
</div>

@if ($showTimeZone)
    <div class="time text-left margin-top-5 fc-white">
        <small>* All times are in Eastern Time (ET)</small>
    </div>
@endif
