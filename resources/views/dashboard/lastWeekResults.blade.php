<h3 class="fc-white">Last Week's Results</h3>

@if ($hasLastWkGames)
    <div class="table-responsive table-header">
        <table class="table table-bordered margin-bottom-0">
            <colgroup>
                <col style="width:200px">
                <col>
            </colgroup>
            <thead>
                <tr>
                    <th style="padding: 3px" class="text-center">Final Score</th>
                    <th style="padding: 3px" class="text-center">Winner</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="table-responsive margin-bottom-0" style="height:calc(100% - 85px);overflow:auto">
        <table class="table table-bordered margin-bottom-0">
            <colgroup>
                <col style="width:200px">
                <col>
            </colgroup>
            <tbody>
                @foreach ($lastWeekResults as $game)
                    <tr>
                        <td data-title="Final Score" class="fc-yellow middle fs-25">
                            <a href="{{action('GamesController@show', [$game->id])}}">
                                <div class="pull-left width50">
                                    <img src="img/team_logos/{{$game->home_logo}}" height="40" width="45" alt="{{$game->home}}">
                                    <div class="scores">
                                        {{$game->home_score}}
                                    </div>
                                </div>
                                <div class="pull-right width50">
                                    <img src="img/team_logos/{{$game->away_logo}}" height="40" width="45" alt="{{$game->away}}">
                                    <div class="scores">
                                        {{$game->away_score}}
                                    </div>
                                </div>
                            </a>
                        </td>
                        <td data-title="Winner" class="middle">
                            <img src="/img/profilePics/{{$game->avatar}}" height="40" width="40" alt="{{$game->username}}"><br>
                            <small>{{$game->username}}</small>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p class="width60 margin-0-auto fc-grey margin-top-50" style="font-size: 1.5em;">
        There were no games last week.
    </p>
@endif
