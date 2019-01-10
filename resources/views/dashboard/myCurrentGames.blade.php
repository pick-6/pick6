<?php
$includeTitle =  $includeTitle ?? true;
$showTitle = $includeTitle == 'true' ? true : false;

$showGameTime = $showGameTime ?? false;
$showPicksAvail = $showPicksAvail ?? false;

$onDash = $onDash ?? true;
$isOnDash = $onDash == 'true' ? true : false;

$showCity = $showCity ?? false;
?>

@if($showTitle)
    <h3 class="fc-white">{{$myCurrentGamesTitle ?? $title}}</h3>
@endif

@if ($hasCurrentGames)
    @include('game.list', [
        'games' => $myCurrentGames,
        'dates' => $datesOfMyCurrentGames,
        'showGameTime' => $showGameTime,
        'showPicksAvail' => $showPicksAvail,
        'onDash' => $isOnDash,
        'showCity' => $showCity
    ])
@else
    <p class="noGames margin-0-auto fc-grey margin-top-50" style="font-size: 1.5em;">
        You're not involved in any games yet.
    </p>
    <div id="startPlayingBtn">
        <a class="btn btn-xl startPlayingBtn" data-role-ajax="play">JOIN A GAME</a>
    </div>
@endif
