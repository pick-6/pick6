<h3 class="fc-white">Leaderboard</h3>

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
    <div class="table-responsive margin-bottom-0" style="height:calc(100% - 85px);overflow:auto">
       <table class="table table-bordered margin-bottom-0">
            <colgroup>
                <col style="width: 55px">
                <col>
                <col style="width: 55px">
            </colgroup>
           <tbody>
                @foreach ($leaderboard as $index => $player)
                    <tr class="{{ ($player->id == Auth::user()->id) ? 'fc-yellow' : '' }}">
                        <td data-title="Rank" class="middle">
                            @if ($index == 0)
                                <img src="/img/gold.png" height="20" width="20" alt="First Place">
                            @elseif ($index == 1)
                                <img src="/img/silver.png" height="20" width="20" alt="Second Place">
                            @elseif ($index == 2)
                                <img src="/img/bronze.png" height="20" width="20" alt="Third Place">
                            @else
                                {{$index+1}}.
                            @endif
                        </td>
                        <td data-title="Player Name" class="text-left">
                            <img src="/img/profilePics/{{$player->avatar}}" height="25" width="25" alt="{{$player->first_name}} {{$player->last_name}}" title="{{$player->username}}">
                            <div class="text-left middle inline-block leaderboardName">
                                {{$player->first_name}} {{$player->last_name}}
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
