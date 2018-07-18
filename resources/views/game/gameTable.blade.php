<table class="table table-bordered margin-bottom-0">
    <colgroup>
        <col style="width:75px"/>
        <col style="width:75px"/>
        <col style="width:75px"/>
        <col style="width:75px"/>
        <col style="width:75px"/>
        <col style="width:75px"/>
        <col style="width:75px"/>
        <col style="width:75px"/>
        <col style="width:75px"/>
        <col style="width:75px"/>
        <col style="width:75px"/>
    </colgroup>
    <tr>
        <th class="gameTableHeader">
            <a class="fc-black" href="#gameDetails" data-toggle="modal" title="View Game/Pot Details">
                <i class="fas fa-info-circle fs-20"></i>
            </a>
        </th>
        <!-- Creates numbers 0-9 going across -->
        @for ($column = 0; $column < 10; $column++)
            <th class="gameTableHeader">{{ $gameOver? $randomNumbers['home'][$column]: '?'}}<!-- {{$column}} --></th>
        @endfor
    </tr>

    <!-- Creates numbers 0-9 going down -->
    @for ($row = 0; $row < 10; $row++)
        <tr>
            <th class="gameTableHeader">{{ $gameOver? $randomNumbers['away'][$row]: '?'}}<!-- {{$row}} --></th>
            <!-- Creates all 100 squares on the table -->
            @for ($column = 0; $column < 10; $column++)
                @if (in_array("$column$row", $thisGameSelections))
                    @foreach($squaresSelected as $user)
                        @if($user->square_selection == $column.$row)
                            <td class="notAvailable text-center middle padding-0" data-user="{{$user->id}}" data-id="{{$column}}{{$row}}" data-title="{{$user->username}}" style="background-image: url('/img/profilePics/{{$user->avatar}}');background-size: cover;">
                                @if($user->id != Auth::id())
                                    <div class='showUserContainer'>
                                        <div class='showUserBG'></div>
                                        <a href="{{action('AccountController@show', [$user->id])}}" title="View {{$user->username}}'s Profile" style="cursor:pointer">
                                            <small><span class='showUserName margin-top-10 inline-block'></span></small>
                                        </a>
                                    </div>
                                @endif
                            </td>
                        @endif
                    @endforeach
                @else
                    <td class="middle availableSquare text-center padding-0" data-id="{{$column}}{{$row}}"><i class="fc-green fas"></i></td>
                @endif
            @endfor
        </tr>
    @endfor
</table>
