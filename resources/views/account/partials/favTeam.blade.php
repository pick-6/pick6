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


<script>
    // Add Favorite Team
    $('#accountPage').find("#chooseFavTeamModal .team-list td").on('click', function(){
        var team = $(this).data("id");
        var form = $("#chooseFavTeamModal #addFavTeamForm");
        form.append("<input type='hidden' name='favTeam' value='"+team+"'/>");
        form.submit();
    });

    $('#addFavTeamForm').on('submit', function(e){
        e.preventDefault();

        $team = $(this).find('input[name=favTeam]').val();
        $(this).postForm({
            url: "/account/updateFavTeam/"+$team+"",
            reload: "[data-ajax-load='/favTeam']",
            reloadUrl: "/favTeam",
            forFavTeam: true
        });
    });
</script>
