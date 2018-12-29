<!-- Choose Fav Team Modal -->
<div id="chooseFavTeamModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-center closeModalBtnContainer">
                <button class="close btn closeModalBtn" data-dismiss="modal">&times</button>
            </div>
            <div class="modal-body text-center">
                <div class="list">
                    <h3 class="fc-white text-center margin-top-0 margin-bottom-10">
                        Select Your Favorite Team
                    </h3>
                    @if($hasFavTeam)
                        <div class="table-responsive margin-bottom-15" style="box-shadow: 0px 0px 15px 3px #111;">
                            <div class="currentTeam">
                                Current Favorite Team
                            </div>
                            <table class="col-sm-12 table-bordered table-condensed width100">
                                <tbody>
                                    <tr class="bg-black">
                                        <td data-id="" class="text-left padding-10 fc-yellow fs-20">
                                            <div class="inline-block width20">
                                                <img src="/img/team_logos/{{$favoriteTeam[0]['logo']}}" height="60" width="65" alt="{{$favoriteTeam[0]['name']}}">
                                            </div>
                                            <div class="inline-block width70 middle">
                                                {{$favoriteTeam[0]['city']}} {{$favoriteTeam[0]['name']}}
                                            </div>
                                            <div class="inline-block middle">
                                                <!-- <i class="fas fa-check fc-green"></i> -->
                                                <i class="fas fa-star fc-gold"></i>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <div class="team-list {{ $hasFavTeam ? 'hasFavTeam' : '' }}">
                        @foreach ($allTeams as $team)
                        <?php
                            $favTeam = $hasFavTeam ? $team->id == $favoriteTeam[0]['id'] : false;
                            $isFavTeam = $hasFavTeam && $favTeam;
                        ?>
                            <div class="team">
                                <table class="col-sm-12 table-bordered table-condensed width100">
                                    <tbody>
                                        <tr {{ $isFavTeam ? 'class=bg-black' : '' }}>
                                            <td data-id="{{$team->id}}" class="text-left padding-10 fc-yellow fs-20">
                                                <div class="inline-block width20">
                                                    <img src="/img/team_logos/{{$team->logo}}" height="60" width="65" alt="{{$team->name}}">
                                                </div>
                                                <div class="inline-block width70 middle">
                                                    {{$team->city}} {{$team->name}}
                                                </div>
                                                <div class="inline-block middle icon">
                                                    @if($isFavTeam)
                                                    <!-- <i class="fas fa-check fc-green"></i> -->
                                                    <i class="fas fa-star fc-gold"></i>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
                <form id="addFavTeamForm" action="{{action('AccountController@updateFavTeam')}}" method="POST">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>


<!-- <script>
    var $modal = $("#chooseFavTeamModal"),
        $teamList = $modal.find(".team-list"),
        $team = $teamList.find(".team"),
        $icon = $team.find(".icon");

    $team.hover(
        function() {
            $(this).find(".icon").append($("<i>").addClass("far fa-star fc-gold"));
            toggleStar();
        }, function() {
            $icon.find("i").remove();
        }
    );

    function toggleStar() {
        $icon.find("i").hover(
            function() {
                $(this).removeClass("far");
                $(this).addClass("fas");
            }, function() {
                $(this).removeClass("fas");
                $(this).addClass("far");
            }
        );
    }
</script> -->
