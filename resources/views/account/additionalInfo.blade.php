<?php
    $showBio = false
?>

<div class="text-center">
    @if($hasWinnings)
        <div class="margin-top-5">
            <div class="fc-yellow inline-block">Total Winnings:</div>
            <div class="fc-grey inline-block">{{$totalWinnings}}</div>
        </div>
    @endif

    @if($hasFavTeam)
        <div class="margin-top-5">
            <div class="fc-yellow inline-block">Favorite Team:</div>
            <div class="fc-grey inline-block">
                {{$favoriteTeam[0]['name']}}
                @if($isLoggedInUser)
                    <a href="#chooseFavTeamModal" data-toggle="modal" class="fc-grey">
                        <i class="fa fa-edit margin-left-5"></i>
                    </a>
                @endif
            </div>
        </div>
    @elseif($isLoggedInUser)
        <div class="margin-top-5">
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
