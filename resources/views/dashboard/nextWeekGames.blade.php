<style>
    @media(max-width:700px){
        .nextWeekGames img {
            width: 65px;
            height: 60px;
        }
        .nextWeekGames .fs-12 {
            font-size: 16px!important;
        }
        .nextWeekGames .width50 {
            width: 49%!important;
            display: inline-block;
        }
        .nextWeekGames .pull-left, .nextWeekGames .pull-right {
            float: unset !important;
        }
        .nextWeekGames table tr td a>div{
            vertical-align: top;
        }
        .nextWeekGames .width60 {
            width: 0!important;
        }
    }
</style>

<h3 class="fc-white">Next Week's Games</h3>

@if ($hasNextWeekGames)
    <div id="no-more-tables" class="table-responsive" style="height:calc(100% - 55px);overflow:auto;width:100%">
        <table class="table table-bordered margin-bottom-0">
            <tbody>
                @foreach ($nextWeekGames as $game)
                    <tr>
                        <td class="gameTeams text-left" style="padding:10px;">
                            <a class="fs-12" href="{{action('GamesController@show', [$game->id])}}">
                                <div class="pull-left width50">
                                    <img src="img/team_logos/{{$game->home_logo}}" height="50" width="55" alt="{{$game->home}}">
                                    <div class="text-left middle width60 inline-flex">
                                        {{$game->home}}
                                    </div>
                                </div>
                                <div class="pull-right width50">
                                    <img src="img/team_logos/{{$game->away_logo}}" height="50" width="55" alt="{{$game->away}}">
                                    <div class="text-left middle width60 inline-flex">
                                        {{$game->away}}
                                    </div>
                                </div>
                            </a>
                        </td>
                     </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
@else
    <p class="width60 margin-0-auto fc-grey margin-top-50" style="font-size: 1.5em;">
        No upcoming games next week.
    </p>
@endif
