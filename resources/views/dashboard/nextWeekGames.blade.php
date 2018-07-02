<h3 class="fc-white">Next Week's Games</h3>

@if ($hasNextWeekGames)
    <div id="no-more-tables" class="table-responsive" style="height:calc(100% - 55px);overflow:auto;width:100%">
        @foreach ($datesOfNextWeekGames as $date)
            <h4 class="dateOfGame text-left clear fc-grey">
                <?=date("l, F j<\s\m\a\l\l><\s\up>S</\s\up></\s\m\a\l\l>", strtotime("$date->date_for_week"))?>
            </h4>
            <table class="col-sm-12 table-bordered table-condensed nextWeekGamesTable">
                <tbody>
                    @foreach ($nextWeekGames as $game)
                        @if ($date->date_for_week == $game->date_for_week)
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
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
@else
    <p class="width60 margin-0-auto fc-grey margin-top-50" style="font-size: 1.5em;">
        No upcoming games next week.
    </p>
@endif
