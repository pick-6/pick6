<?php
$includeTitle =  $includeTitle ?? true;
$showTitle = $includeTitle == 'true' ? true : false;
?>

@if($showTitle)
    <h3 class="fc-white">{{$leaderboardTitle ?? $title}}</h3>
@endif

@if($hasLeaders)
    <div class="table-responsive table-header">
       <table class="table table-bordered margin-bottom-0">
            <colgroup>
                <col style="width: 55px">
                <col>
                <col style="width: 55px">
            </colgroup>
            <thead>
                <tr>
                    <th style="padding: 3px" class="text-center">Rank</th>
                    <th style="padding: 3px">Player Name</th>
                    <th style="padding: 3px" class="text-center">Wins</th>
                </tr>
            </thead>
        </table>
    </div>
    <div id="leaderboard" class="table-responsive margin-bottom-0" style="height:calc(100% - 85px);overflow:auto">
       <table class="table table-bordered margin-bottom-0">
            <colgroup>
                <col style="width: 55px">
                <col>
                <col style="width: 55px">
            </colgroup>
           <tbody>
               <?php $currentRank = 1;?>
                @foreach ($leaderboard as $rank => $player)
                    <tr class="{{ ($player->id == Auth::id()) ? 'fc-yellow' : 'fc-white' }}">
                        <td data-title="Rank" class="middle">
                            @if ($rank == 0)
                                <img src="/img/gold.png" height="20" width="20" alt="First Place">
                            @elseif ($rank == 1)
                                @if($player->wins == $leaderboard[$rank-1]->wins)
                                    T{{$currentRank}}.
                                @else
                                    <img src="/img/silver.png" height="20" width="20" alt="Second Place">
                                    <?php $currentRank++;?>
                                @endif
                            @elseif ($rank == 2)
                                @if($player->wins == $leaderboard[$rank-1]->wins)
                                    T{{$currentRank}}.
                                @else
                                    <img src="/img/bronze.png" height="20" width="20" alt="Third Place">
                                    <?php $currentRank++;?>
                                @endif
                            @else
                                @if($player->wins == $leaderboard[$rank-1]->wins)
                                    T{{$currentRank}}.
                                @else
                                    <?php $currentRank = $rank+1;?>
                                    @if($player->wins == ($leaderboard[$rank+1]->wins ?? $player->wins == $leaderboard[$rank-1]->wins))
                                        T{{$rank+1}}.
                                    @else
                                        {{$rank+1}}.
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td data-title="Player Name" class="text-left">
                            <img src="/img/profilePics/{{$player->avatar}}" height="25" width="25" alt="{{$player->full_name}}">
                            <div class="text-left middle inline-block leaderboardName">
                                <a data-role-ajax="{{action('AccountController@show', [$player->id])}}" class="{{ ($player->id == Auth::id()) ? 'fc-yellow' : 'fc-white' }}" title="{{$player->full_name}}">{{$player->full_name}}</a>
                            </div>
                        </td>
                        <td data-title="Wins" class="middle">{{$player->wins}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p class="width70 margin-0-auto fc-grey margin-top-50" style="font-size: 1.5em;">
        There are no leaders at this time.
    </p>
@endif
