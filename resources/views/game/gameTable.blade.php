<!-- HOME TEAM NAME -->
<div class="col-xs-12 homeTeamName clear">
    <!-- <div class="text-center homeTeamTop fc-white margin-bottom-5">
        (Top of the table)
    </div> -->
    <h1 class="text-center margin-top-0 fc-white margin-bottom-0 outline-text">
        {{$homeTeam}}
        <img src="/img/team_logos/{{$homeLogo}}" width="40" height="35">
    </h1>
</div>

<table id="gameTable" class="table table-bordered margin-bottom-0 noBorder transparent">
    <colgroup>
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
        <col class="gameTableColumns" />
    </colgroup>
    <tr>
        <td rowspan="12" class="uppercase bold fs-25 hideAwayTeam noBorder cursor-arrow outline-text">
            <div class="verticalTeamName">
                {{$awayTeam}}
                <img src="/img/team_logos/{{$awayLogo}}" width="40" height="35">
            </div>
        </td>
        <td colspan="11" class="text-center uppercase bold fs-25 padding-5 hideHomeTeam noBorder transparent cursor-arrow outline-text">
            {{$homeTeam}}
            <img src="/img/team_logos/{{$homeLogo}}" width="40" height="35">
        </td>
    </tr>
    <tr class="transparent">
        <th class="gameTableHeader">
            <a class="fc-black" href="#gameDetails" data-toggle="modal" title="View Game/Pot Details">
                <i class="fas fa-info-circle fs-20"></i>
            </a>
        </th>
        <!-- Creates numbers 0-9 going across -->
        @for ($column = 0; $column < 10; $column++)
            <th class="gameTableHeader">{{ $gameStarted == 'true'? $randomNumbers['home'][$column]: '?'}}</th>
        @endfor
        <td class="hideGameTableColumn noBorder cursor-arrow"></td>
    </tr>

    <!-- Creates numbers 0-9 going down -->
    @for ($row = 0; $row < 10; $row++)
        <tr class="transparent">
            <th class="gameTableHeader">{{ $gameStarted == 'true'? $randomNumbers['away'][$row]: '?'}}</th>
            <!-- Creates all 100 squares on the table -->
            @for ($column = 0; $column < 10; $column++)
                <?php
                    $winningSelectionId = $gameStarted == 'true' ? $randomNumbers['home'][$column].$randomNumbers['away'][$row] : '?';
                    $isWinningSquare = $gameOver == 'true' ? ($winningSelection == $winningSelectionId) : '';
                ?>
                @if (in_array("$column$row", $thisGameSelections))
                    @foreach($squaresSelected as $user)
                        @if($user->square_selection == $column.$row)
                            <td class="notAvailable text-center middle padding-0 {{ $isWinningSquare ? 'thickLimeGreenBorder' : '' }}" data-user="{{$user->id}}" data-id="{{$column}}{{$row}}" data-title="{{$user->username}}" data-winning-id="{{$winningSelectionId}}" style="background-image: url('/img/profilePics/{{$user->avatar}}');background-size: cover;">
                                @if($user->id != Auth::id())
                                    <a href="{{action('AccountController@show', [$user->id])}}" title="View {{$user->username}}'s Profile" style="cursor:pointer">
                                        <div class='showUserContainer'>
                                            <div class='showUserBG'></div>
                                                <small class="hideOnMobile"><span class='showUserName margin-top-10 inline-block'></span></small>
                                        </div>
                                    </a>
                                @endif
                            </td>
                        @endif
                    @endforeach
                @else
                    <td class="middle availableSquare text-center padding-0 {{ $isWinningSquare ? 'thickLimeGreenBorder' : '' }}" data-id="{{$column}}{{$row}}" data-winning-id="{{$winningSelectionId}}"><i class="fc-green fas"></i></td>
                @endif
            @endfor
            <td class="hideGameTableColumn noBorder cursor-arrow"></td>
        </tr>
    @endfor
</table>

<!-- AWAY TEAM NAME FOR MOBILE, TABLET (shows below the table) -->
<div class="col-xs-12 awayTeamName fc-white clear">
    <h1 class="text-center margin-bottom-0 margin-top-5 outline-text">
        {{$awayTeam}}
        <img src="/img/team_logos/{{$awayLogo}}" width="40" height="35">
    </h1>
    <div class="text-center fc-white">
        (Left side of the table)
    </div>
</div>
