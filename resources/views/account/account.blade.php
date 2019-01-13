
<style>
    #accountPage .showAvatarContainer {
        background-image: url('/img/profilePics/{{$avatar}}');
    }
</style>
<div class="text-center" id="accountPage">
    <section id="accountInfo" class="padding-0 col-md-3">
        <div class="padding-10">
            <div class="margin-bottom-10 fc-yellow">
                @if(Auth::user()->email == 'mattvaldez01@gmail.com')
                    <p class="fc-red margin-0">
                        User Id: {{$id}}
                    </p>
                @endif
                <h3 class="margin-0 ellipsis" style="white-space: normal;">
                    {{$first_name}}
                    {{$last_name}}
                </h3>
                <p class="fc-grey margin-0 ellipsis">
                    {{$username}}
                </p>
                @if($isLoggedInUser)
                    <p class="text-muted ellipsis">
                        {{$email}}
                    </p>
                @endif
            </div>
            <div class="margin-0-auto showAvatarContainer smallGreyBorder">
                @if($isLoggedInUser)
                    <form id="changeProfileImage" enctype="multipart/form-data" action="{{action('AccountController@uploadProfilePic')}}" method="POST">
                        <input type="file" name="avatar" id="chooseProfilePic" class="hidden chooseProfilePic">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" id="submitProfilePic" class="hidden submitProfilePic">
                    </form>
                    <a id="changePhoto" class="changePhoto">
                        <div class='showAvatarBG'>
                            <p class="text-center fc-white" style="margin-top:60px;font-size:2rem;">
                                <i class="fas" style="font-size:6rem;"></i><br />
                                <small class="uppercase showAvatar"></small>
                            </p>
                        </div>
                    </a>
                @endif
            </div>
            @include('account.additionalInfo')
        </div>
        @if($isLoggedInUser)
            <div class="absolute dropdown hideOnTablet" style="bottom:0;padding-bottom:10px">
                @include('partials.dropdown.item', [
                    'isDropDownBtn' => true,
                    'icon' => 'cog',
                ])
                <ul class="dropdown-menu new-menu padding-0 text-left" style="top:-30px;left: 45px;background:#444">
                    @include('partials.dropdown.account-items')
                </ul>
            </div>
            <div class="showOnTablet">
                <ul class="padding-0 text-left new-menu">
                    @include('partials.dropdown.account-items')
                </ul>
            </div>
            @include('account.deleteAccount')
        @endif

        @if ($hasCurrentGames)
            <div class="scroll margin-top-75 showOnTablet">
                <a data-href="#currentGames" class="btn btn-lg">See Current Games</a>
            </div>
        @endif
    </section>

    <section id="currentGames" class="padding-10 myCurrentGames col-md-9 {{ $hasCurrentGames ? '' : 'hideOnTablet'}}">
        @if($isLoggedInUser)
            <a class="dropdown-toggle no-decor" data-toggle="dropdown">
                <h3 class="fc-white margin-top-0 inline section-title">My Current Games</h3>
                <i class="fas fa-caret-down inline fc-white margin-left-5"></i>
            </a>
            <ul class="dropdown-menu new-menu padding-0 text-left" style="top:40px;left: calc(50% - 145px);background:#444">
                @include('partials.dropdown.item', [
                    'icon' => 'calendar-alt',
                    'label' => $gamesForWeekTitle,
                    'url' => '/gamesForWeek',
                    'forSectionLoad' => true,
                    'subLabel' => '(Games For The Week)'
                ])
                @include('partials.dropdown.item', [
                    'icon' => 'football-ball',
                    'label' => $myCurrentGamesTitle,
                    'url' => '/myCurrentGames',
                    'forSectionLoad' => true
                ])
                @include('partials.dropdown.item', [
                    'icon' => 'calendar-check',
                    'label' => $lastWeekResultsTitle,
                    'url' => '/lastWeekResults',
                    'forSectionLoad' => true
                ])
                @include('partials.dropdown.item', [
                    'icon' => 'trophy',
                    'label' => $leaderboardTitle,
                    'url' => '/leaderboard',
                    'forSectionLoad' => true
                ])
                @include('partials.dropdown.item', [
                    'icon' => 'calendar-plus',
                    'label' => $nextWeekGamesTitle,
                    'url' => '/nextWeekGames',
                    'forSectionLoad' => true
                ])
                @if($hasWinnings)
                @include('partials.dropdown.item', [
                    'icon' => 'dollar-sign',
                    'label' => 'My Winning Games',
                    'url' => '/winningGames',
                    'forSectionLoad' => true
                ])
                @endif
            </ul>
        @else
            <a class="dropdown-toggle no-decor {{$hasWinnings ? '' : 'cursor-arrow'}}" data-toggle="dropdown">
                <h3 class="fc-white margin-top-0 inline section-title">{{$first_name.'\'s'}} Current Games</h3>
                @if($hasWinnings)
                    <i class="fas fa-caret-down inline fc-white margin-left-5"></i>
                @endif
            </a>
            @if($hasWinnings)
                <ul class="dropdown-menu new-menu padding-0 text-left" style="top:40px;left: calc(50% - 145px);background:#444">
                    @include('partials.dropdown.item', [
                        'icon' => 'football-ball',
                        'label' => "$first_name's Current Games",
                        'url' => '/myCurrentGames',
                        'forSectionLoad' => true
                    ])

                    @include('partials.dropdown.item', [
                        'icon' => 'dollar-sign',
                        'label' => "$first_name's Winning Games",
                        'url' => '/winningGames',
                        'forSectionLoad' => true
                    ])
                </ul>
            @endif
        @endif
        <div id="loadedSection" class="margin-top-10">
            @if ($hasCurrentGames)
                @include('game.list', ['games' => $currentGames, 'dates' => $datesOfMyCurrentGames])
            @else
                <div style="transform:translateY(10vh);">
                    <p class="noGames margin-0-auto fc-grey margin-top-50" style="font-size: 1.5em;">
                        {{$isLoggedInUser ? 'You\'re' : $first_name.'\'s'}} not involved in any games yet.
                    </p>
                    @if($isLoggedInUser)
                        <div id="startPlayingBtn">
                            <a data-role-ajax="play" class="btn btn-xl startPlayingBtn">JOIN A GAME</a>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </section>
</div>

<script type="text/javascript">
    $(".scroll a").bind("click",function(t){
        var l = $(this);
        $('html, body').find("section").stop().animate({
            scrollTop:$(l.data("href")).offset().top-65
        },1500)
        t.preventDefault();
    });

    $("[data-role-ajaxsection]").on("click", function(){
        var url = $(this).data("role-ajaxsection"),
            title = "",
            isGamesForWeek = url == "/gamesForWeek",
            isPreSeason = {{boolval($isPreSeason) ? 'true' : 'false'}};

        switch (url) {
            case "/gamesForWeek":
                title = "{{$gamesForWeekTitle}}";
                break;
            case "/myCurrentGames":
                forLoggedInUser = "{{$myCurrentGamesTitle}}";
                forOtherUser = "{{$first_name}}'s {{$myCurrentGamesTitle}}";
                title = {{boolval($isLoggedInUser) ? 'true' : 'false'}} ? forLoggedInUser : forOtherUser;
                break;
            case "/lastWeekResults":
                title = "Last Week's Results";
                break;
            case "/leaderboard":
                title = "{{$leaderboardTitle}}";
                break;
            case "/nextWeekGames":
                title = "Next Week's Games";
                break;
            case "/winningGames":
                forLoggedInUser = "{{$winningGamesTitle}}";
                forOtherUser = "{{$first_name}}'s {{$winningGamesTitle}}";
                title = {{boolval($isLoggedInUser) ? 'true' : 'false'}} ? forLoggedInUser : forOtherUser;
                break;
        }

        $.ajax({
            url: url,
            data:
            {
                includeTitle: false,
                showPicksAvail: true,
                showGameTime: true,
                showCity: true,
                onDash: false,
                userId: {{$id}}
            }
        }).done(function(data){
            $("#loadedSection").html(data);
            $(".section-title").text(title);
            if (isGamesForWeek && isPreSeason) {
                $preseason = $("<span>").addClass("fc-yellow").text("PreSeason ");
                $(".section-title").prepend($preseason);
            }
            var links = $("#loadedSection").find("[data-role-ajax]");
            $("#loadedSection").pageControl(links);
        });
    });

    // Upload Profile Pic from Account Page
    $('#accountPage').find('.changePhoto').click(function(){
        $('.chooseProfilePic').trigger('click');
    });

    $('#accountPage').find('.chooseProfilePic')
        .on('click touchstart', function(){
            $(this).val('');
        })
        .change(function(e) {
            $(".submitProfilePic").trigger('click');
        });

    // Change Profile Pic on Account Page
    $('#accountPage').find('.showAvatarContainer').on('mouseover mouseout', function(e){
        if (e.type == 'mouseover')
        {
            $(this).find('.showAvatar').text('Change Photo');
            $(this).find('.showAvatar').parent().find('i').addClass('fa-camera');
            $(this)
            .css({
                'position': 'relative',
                'z-index': '1',
            });
            $(this).find('.showAvatarBG')
            .css({
                'position': 'absolute',
                'z-index': '-1',
                'background': '#000',
                'opacity': '.65',
                'width': '100%',
                'height': '100%'
            });
        }
        else
        {
            $(this).find('.showAvatar').text('');
            $(this).find('.showAvatar').parent().find('i').removeClass('fa-camera');
            $(this).find('.showAvatarBG')
            .css({
                'background': 'initial',
            });
        }
    });

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
            reload: "/account",
        });
    });

    $('#changeProfileImage').on('submit', function(e){
        e.preventDefault();

        $(this).uploadFile({
            url: "/upload",
            reload: "/account",
            data: new FormData(this),
            getAvatar: true
        });
    });
</script>
