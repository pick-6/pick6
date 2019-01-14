<?php
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
    $showWinner = $showWinner ?? true;
    $showCity = $showCity ?? true;
?>

<style>
    #currentGames div#no-more-tables {
        max-height: 570px;
        overflow: auto;
    }
</style>

<div id="no-more-tables" class="table-responsive">
    @if(!$dates)
        @include('game.list-table.partial')
    @else
        @foreach ($dates as $date)
            <h4 class="dateOfGame text-left clear fc-grey">
                <?=date("l, F j<\s\m\a\l\l><\s\up>S</\s\up></\s\m\a\l\l>", strtotime("$date->date_for_week"))?>
            </h4>
            @include('game.list-table.partial')
        @endforeach
    @endif
</div>

@if ($showTimeZone)
    <div class="time text-left margin-top-5 fc-white">
        <small>* All times are in Eastern Time (ET)</small>
    </div>
@endif
