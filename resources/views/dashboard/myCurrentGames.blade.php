<style>
    @media(max-width:700px){
        .myCurrentGames img {
            width: 65px;
            height: 60px;
        }
        .myCurrentGames .fs-12 {
            font-size: 16px!important;
        }
        .myCurrentGames .width50 {
            width: 49%!important;
            display: inline-block;
        }
        .myCurrentGames .pull-left, .myCurrentGames .pull-right {
            float: unset !important;
        }
        .myCurrentGames table tr td a>div{
            vertical-align: top;
        }
        .myCurrentGames .width70 {
            width: 0!important;
        }
    }
</style>

<h3 class="fc-white">My Current Games</h3>

@if ($hasCurrentGames)
    <div id="no-more-tables" class="table-responsive">
        <table class="table table-bordered margin-bottom-0">
             <colgroup>
                 <col>
                 <col style="width: 35%">
             </colgroup>
            <tbody>
            @foreach ($myCurrentGames as $game)
                <tr>
                    <td class="middle text-center" style="padding:10px;">
                        <a href="{{action('GamesController@show', [$game->game_id])}}">
                             <div class="pull-left width50 fs-12">
                                 <img src="img/team_logos/{{$game->home_logo}}" height="30" width="35" alt="{{$game->home}}">
                                 <div class="text-left middle width70 inline-flex">
                                     {{$game->home}}
                                 </div>
                             </div>
                             <div class="pull-right width50 fs-12">
                                 <img src="img/team_logos/{{$game->away_logo}}" height="30" width="35" alt="{{$game->away}}">
                                 <div class="text-left middle width70 inline-flex">
                                     {{$game->away}}
                                 </div>
                             </div>
                        </a>
                    </td>

                     <td data-title="" id="playGameBtn" class="middle padding-0">
                        <a href="{{action('GamesController@show', [$game->game_id])}}" class="btn playGameBtn">
                             GO TO GAME
                         </a>
                     </td>
                 </tr>
             @endforeach
             </tbody>
         </table>
     </div>
 @else
     <p class="width50 margin-0-auto fc-grey margin-top-50" style="font-size: 1.5em;">
         You're not involved in any games yet.
     </p>
     <div id="startPlayingBtn">
         <a href="/play" class="btn btn-xl startPlayingBtn">JOIN A GAME</a>
     </div>
 @endif
