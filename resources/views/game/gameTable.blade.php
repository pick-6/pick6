<table class="table table-bordered margin-bottom-0">
    <colgroup>
        <col style="width:9%"/>
        <col style="width:9%"/>
        <col style="width:9%"/>
        <col style="width:9%"/>
        <col style="width:9%"/>
        <col style="width:9%"/>
        <col style="width:9%"/>
        <col style="width:9%"/>
        <col style="width:9%"/>
        <col style="width:9%"/>
        <col style="width:9%"/>
    </colgroup>
    <tr>
        <th class="gameTableHeader">
            <a class="fc-black" href="#gameDetails" data-toggle="modal" title="View Game/Pot Details">
                <i class="fas fa-info-circle fs-20"></i>
            </a>
        </th>
        <!-- Creates numbers 0-9 going across -->
        @for ($column = 0; $column < 10; $column++)
            <th class="gameTableHeader">{{ $gameStarted == 'true'? $randomNumbers['home'][$column]: '?'}}<!-- {{$column}} --></th>
        @endfor
    </tr>

    <!-- Creates numbers 0-9 going down -->
    @for ($row = 0; $row < 10; $row++)
        <tr>
            <th class="gameTableHeader">{{ $gameStarted == 'true'? $randomNumbers['away'][$row]: '?'}}<!-- {{$row}} --></th>
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
        </tr>
    @endfor
</table>
