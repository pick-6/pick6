<?php
    $showBio = false
?>

<div class="text-center">
    @if($hasWinnings)
        <div class="margin-top-20">
            <div class="fc-yellow fs-16">Total Winnings:</div>
            <div class="fc-grey">
                <h3 class="margin-0">{{$totalWinnings}}</h3>
            </div>
            <div class="margin-top-5">
                <button data-role-ajaxsection="/winningGames" class="btn btn-xs">See Wins</button>
            </div>
        </div>
    @endif

    @if($hasFavTeam)
        <div class="margin-top-20">
            <div class="fc-yellow fs-16">
                Favorite Team:
                @if($isLoggedInUser)
                    <a href="#chooseFavTeamModal" data-toggle="modal" class="fc-grey fs-14">
                        <i class="fa fa-edit margin-left-5"></i>
                    </a>
                @endif
            </div>
            <div class="fc-grey margin-top-5">
                <img src="/img/team_logos/{{$favoriteTeam[0]['logo']}}" height="80" width="85" alt="{{$favoriteTeam[0]['name']}}">
                <h4 class="margin-5">{{$favoriteTeam[0]['name']}}</h4>
            </div>
        </div>
    @elseif($isLoggedInUser)
        <div class="margin-top-20">
            <div class="fc-grey inline-block">
                <a href="#chooseFavTeamModal" class="btn btn-xs" data-toggle="modal">
                    <i class="fas fa-plus"></i>
                    Add Favorite Team
                </a>
            </div>
        </div>
    @endif
    @include('account.chooseFavTeamModal')

    @if($showBio)
        <!-- <div class="margin-top-5">
            <div class="fc-yellow inline-block" style="width:35px;vertical-align:top">Bio:</div>
            <div class="fc-grey overflow-auto inline-block" style="height:84px;width:calc(100% - 40px);">
                This a bio about me. This a bio about me. This a bio about me. This a bio about me. This a bio about me.
                This a bio about me. This a bio about me. This a bio about me. This a bio about me. This a bio about me. This a bio about me.
                This a bio about me. This a bio about me.
            </div>
        </div> -->
    @endif
</div>
