<?php
$includeTitle =  $includeTitle ?? true;
$showTitle = $includeTitle == 'true' ? true : false;
?>

@if($showTitle)
    <h3 class="fc-white">{{$lastWeekResultsTitle ?? $title}}</h3>
@endif

@if ($hasLastWkGames)
    <div class="table-responsive table-header">
        <table class="table table-bordered margin-bottom-0">
            <colgroup>
                <col>
                <col style="width:120px">
            </colgroup>
            <thead>
                <tr>
                    <th style="padding: 3px" class="text-center">Final Score</th>
                    <th style="padding: 3px;" class="text-center">Winner</th>
                </tr>
            </thead>
        </table>
    </div>
    <div id="last-week-table" class="table-responsive margin-bottom-0" style="height:calc(100% - 85px);overflow:auto">
        <table class="table table-bordered margin-bottom-0">
            <colgroup>
                <col>
                <col style="width:120px">
            </colgroup>
            <tbody>
                @foreach ($lastWeekResults as $game)
                    <tr>
                        <td data-title="Final Score" class="fc-yellow middle fs-25">
                            <a data-role-ajax="{{action('GamesController@show', [$game->game_id])}}">
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
                        <td data-title="Winner" class="middle" style="padding:5px;">
                            <a data-role-ajax="{{action('AccountController@show', [($game->id == Auth::id()) ? '' : $game->id])}}">
                                <img src="/img/profilePics/{{$game->avatar}}" height="40" width="40" alt="{{$game->full_name}}">
                                <div class="winningUsername {{$game->id == Auth::user()->id ? 'fc-yellow' : 'fc-white'}}" title="{{$game->full_name}}">
                                    <small>{{$game->full_name}}</small>
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
        There were no games last week.
    </p>
@endif
