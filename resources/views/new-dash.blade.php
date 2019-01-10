<style>
    .new-dashboard #loadedSection table {
        margin-bottom: 10px;
    }

    .new-dashboard #loadedSection h4 small {
        color: #000!important;
    }

    .new-dashboard #loadedSection h4 {
        position: sticky;
        top: 0px;
        z-index: 3;
        background-color: var(--yellow-font)!important;
        color: #000!important;
        border: 1px solid lightgrey;
        width: auto;
        padding: 5px;
        margin-bottom: 0px;
    }

    .new-dashboard .new-menu {
        top: 40px;
        left: calc(50% - 145px);
        background: #444;
    }
    .new-dashboard .col-md-3,
    .new-dashboard .col-md-9 {
        height: calc(100vh - 150px);
    }
</style>

<!-- Dashboard -->
<div class="new-dashboard text-center">
    <div class="col-md-3">
        @include('partials.sidebar')
    </div>
    <div class="col-md-9">

        <a class="dropdown-toggle no-decor" data-toggle="dropdown">
            <h3 class="fc-white margin-top-0 inline section-title">
                {{$gamesForWeekTitle}}
            </h3>
            <i class="fas fa-caret-down inline fc-white margin-left-5"></i>
        </a>
        <ul class="dropdown-menu new-menu padding-0 text-left">
            @include('partials.dropdown.item', [
                'icon' => 'calendar-alt',
                'label' => $gamesForWeekTitle,
                'url' => '/gamesForWeek',
                'forSectionLoad' => true
            ])
            @include('partials.dropdown.item', [
                'icon' => 'football-ball',
                'label' => $myCurrentGamesTitle,
                'url' => '/myCurrentGames',
                'forSectionLoad' => true
            ])
            @include('partials.dropdown.item', [
                'icon' => 'calendar-check',
                'label' => 'Last Week\'s Results',
                'url' => '/lastWeekResults',
                'forSectionLoad' => true
            ])
            @include('partials.dropdown.item', [
                'icon' => 'trophy',
                'label' => 'Leaderboard',
                'url' => '/leaderboard',
                'forSectionLoad' => true
            ])
            @include('partials.dropdown.item', [
                'icon' => 'calendar-plus',
                'label' => 'Next Week\'s Games',
                'url' => '/nextWeekGames',
                'forSectionLoad' => true
            ])
        </ul>
        <div id="loadedSection"></div>
    </div>
</div>

<script>
    $this = $('.new-dashboard');
    $loadedSection = $this.find("#loadedSection");

    $("[data-role-ajaxsection]").on("click", function(){
        var url = $(this).data("role-ajaxsection"),
            title = "";

        switch (url) {
            case "/gamesForWeek":
                title = "{{$gamesForWeekTitle}}";
                break;
            case "/myCurrentGames":
                title = "{{$myCurrentGamesTitle}}";
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
        }

        $.ajax({
            url: url,
            data:
            {
                includeTitle: false,
                showPicksAvail: true,
                showGameTime: true,
                showCity: true,
                onDash: false
            }
        }).done(function(data){
            $loadedSection.html(data);
            $this.find(".section-title").text(title);
            var links = $loadedSection.find("[data-role-ajax]");
            $loadedSection.pageControl(links);
        });
    });

    $.ajax({
        url: "/gamesForWeek",
        data: { includeTitle: false },
    }).done(function(data){
        $loadedSection.html(data);
        var links = $loadedSection.find("[data-role-ajax]");
        $loadedSection.pageControl(links);
    });

</script>
