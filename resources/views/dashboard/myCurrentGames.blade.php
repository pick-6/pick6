<h3 class="fc-white">My Current Games</h3>

@if ($hasCurrentGames)
    @include('game.list', [
        'games' => $myCurrentGames,
        'dates' => false,
        'showGameTime' => false,
        'showPicksAvail' => false,
        'onDash' => true
    ])
@else
    <p class="noGames margin-0-auto fc-grey margin-top-50" style="font-size: 1.5em;">
        You're not involved in any games yet.
    </p>
    <div id="startPlayingBtn">
        <a class="btn btn-xl startPlayingBtn" data-role-ajax="play">JOIN A GAME</a>
    </div>
@endif
