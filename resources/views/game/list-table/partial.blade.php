@include('game.list-table.table',
[
    'games' => $games,
    'showTime' => $showGameTime,
    'showPicksAvail' => $showPicksAvail,
    'showBtn' => $showPlayGameBtn,
    'showTeamName' => $showTeamName,
    'showPrice' => $showPrice,
    'showGameId' => $showGameId,
    'onDash' => $onDash,
    'showWinner' => $showWinner,
    'isNextWeekList' => $isNextWeekList,
    'showCity' => $showCity
])
