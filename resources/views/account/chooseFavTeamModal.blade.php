<!-- Choose Fav Team Modal -->
<div id="chooseFavTeamModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-center closeModalBtnContainer">
                <button class="close btn closeModalBtn" data-dismiss="modal">&times</button>
            </div>
            <div class="modal-body text-center">
                <div class="teamsList">
                    <h3 class="fc-white text-center margin-top-0 margin-bottom-10">
                        Select Your Favorite Team
                    </h3>
                    <div id="no-more-tables" class="table-responsive">
                        <table class="col-sm-12 table-bordered table-condensed width100">
                            <tbody>
                                @foreach ($allTeams as $team)
                                    <tr style="background: {{ $hasFavTeam ? ($team->id == $favoriteTeam[0]['id'] ? '#000' : '') : ''}};">
                                        <td data-id="{{$team->id}}" class="text-left padding-10 fc-yellow fs-20">
                                            <div class="inline-block width20">
                                                <img src="/img/team_logos/{{$team->logo}}" height="60" width="65" alt="{{$team->name}}">
                                            </div>
                                            <div class="inline-block width70 middle">
                                                {{$team->name}}
                                            </div>
                                            <div class="inline-block middle">
                                                @if($hasFavTeam)
                                                    @if($team->id == $favoriteTeam[0]['id'])
                                                        <i class="fas fa-check fc-green"></i>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <form id="addFavTeamForm" action="{{action('AccountController@updateFavTeam')}}" method="POST">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>
