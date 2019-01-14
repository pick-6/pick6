
<style>
    #accountPage .showAvatarContainer {
        background-image: url('/img/profilePics/{{$avatar}}');
    }
</style>
<div class="text-center" id="accountPage">
    <section id="accountInfo" class="padding-0 col-md-3">
        <div class="padding-10">
            <div class="margin-bottom-10 fc-yellow">
                @if($isAdmin)
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
        <a class="dropdown-toggle no-decor {{$hasWinnings || $isLoggedInUser  ? '' : 'cursor-arrow'}}" data-toggle="dropdown">
            <h3 class="fc-white margin-top-0 inline section-title">{{$myCurrentGamesTitle}}</h3>
            @if($hasWinnings || $isLoggedInUser)
                <i class="fas fa-caret-down inline fc-white margin-left-5"></i>
            @endif
        </a>
        @if($hasWinnings || $isLoggedInUser)
            <ul class="dropdown-menu new-menu padding-0 text-left" style="top:40px;left: calc(50% - 145px);background:#444">
                @if($isLoggedInUser)
                    @include('partials.dropdown.item', [
                        'icon' => 'calendar-alt',
                        'label' => 'Games For The Week',
                        'url' => '/gamesForWeek',
                        'forSectionLoad' => true,
                    ])
                @endif
                @include('partials.dropdown.item', [
                    'icon' => 'football-ball',
                    'label' => $myCurrentGamesTitle,
                    'url' => '/myCurrentGames',
                    'forSectionLoad' => true
                ])
                @if($isLoggedInUser)
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
                @endif
                @if($hasWinnings)
                    @include('partials.dropdown.item', [
                        'icon' => 'dollar-sign',
                        'label' => $winningGamesTitle,
                        'url' => '/winningGames',
                        'forSectionLoad' => true
                    ])
                @endif
            </ul>
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
                title = "<?php echo $gamesForWeekTitle ?>";
                break;
            case "/myCurrentGames":
                title = "<?php echo $myCurrentGamesTitle?>";
                break;
            case "/lastWeekResults":
                title = "<?php echo $lastWeekResultsTitle?>";
                break;
            case "/leaderboard":
                title = "<?php echo $leaderboardTitle ?>";
                break;
            case "/nextWeekGames":
                title = "<?php echo $nextWeekGamesTitle ?>";
                break;
            case "/winningGames":
                title = "<?php echo $winningGamesTitle ?>";
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
            forceReload: true
        });
    });

    $('#changeProfileImage').on('submit', function(e){
        e.preventDefault();

        $(this).uploadFile({
            url: "/upload",
            reload: "/account",
            forceReload: true,
            data: new FormData(this),
            getAvatar: true
        });
    });
</script>
