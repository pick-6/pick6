<?php
    $isGameOver = $isGameOver ?? false;
    $isGameStarted = $isGameStarted ?? false;
    $isGameCancel = $isGameCancel ?? false;
    $picksMade = $picksMade ?? 0;
    $picksAvail = 100 - $picksMade;
    $picks = $picksAvail == 1 ? "pick" : "picks" ;
    $bgColor = "";
    $labelText = "";
    $width = $isGameStarted || $isGameCancel || $isGameOver ? 100 : $picksAvail;

    switch (true) {
        case $picksMade <= 25:
            $bgColor = "success";
            break;
        case $picksMade <= 50:
            $bgColor = "info";
            break;
        case $picksMade <= 75:
            $bgColor = "warning";
            break;
        case $picksMade <= 100:
            $bgColor = "danger";
            break;
    }

    switch (true) {
        case $picksMade == 100:
            $labelText = "Sorry, Game is Full";
            break;
        case $picksMade >= 90 && $picksMade < 100:
            $labelText = "Hurry, only $picksAvail $picks left!";
            break;
        case $picksMade > 0 && $picksMade < 100:
            $labelText = "$picksAvail Picks Available";
            break;
        default:
            $labelText = "Be the first to pick!";
            break;
    }

    switch (true) {
        case $isGameOver == true:
            $labelText = "Game Over";
            $bgColor = "black";
            break;
        case $isGameCancel == true:
            $labelText = "Game Cancelled";
            $bgColor = "danger";
            break;
        case $isGameStarted == true:
            $labelText = "Game Started";
            break;
    }
?>
    <div class="absolute width25">
        <div id="availablePicks">
            <div id="availablePicksBar" class="bg-{{$bgColor}}" style="width: {{$width}}%"></div>
        </div>
        <div id="availablePicksLabel">
            <small><i>{{$labelText}}</i></small>
        </div>
    </div>
