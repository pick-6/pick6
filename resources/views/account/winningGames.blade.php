<?php
$includeTitle =  $includeTitle ?? true;
$showTitle = $includeTitle == 'true' ? true : false;
?>

@if($showTitle)
    <h3 class="fc-white">{{$title}}</h3>
@endif

@if ($hasWinnings)
    @include('game.list', [
        'games' => $winningGames,
        'dates' => $datesOfWinningGames,
        'showPicksAvail' => false,
    ])
@else
    <p class="noGames margin-0-auto fc-grey margin-top-50" style="font-size: 1.5em;">
        {{ $isLoggedInUser ? "You haven't" : $usersFirstName." "."hasn't" }} won any games yet.
    </p>
@endif
