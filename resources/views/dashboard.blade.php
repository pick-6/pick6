<!-- Dashboard -->
<div class="dashboard text-center">
    @include('dashboard.dropDown')
    <!-- Games For The Week -->
    <div class="col-md-7">
        <div class="dashboardSection gamesForWeek" data-load="/gamesForWeek">
            @include('dashboard.gamesForWeek')
        </div>
    </div>
    <!-- My Current Games -->
    <div class="col-md-5 hideOnTablet">
        <div class="dashboardSection myCurrentGames" data-load="/myCurrentGames">
            @include('dashboard.myCurrentGames')
        </div>
    </div>
    <!-- Last Week's Results -->
    <div class="col-md-4 hideOnTablet">
        <div class="dashboardSection lastWeekResults" data-load="/lastWeekResults">
            @include('dashboard.lastWeekResults')
        </div>
    </div>
    <!-- Leaderboard -->
    <div class="col-md-4 hideOnTablet">
        <div class="dashboardSection leaderboard" data-load="/leaderboard">
            @include('dashboard.leaderboard')
        </div>
    </div>
    <!-- Next Week's Games -->
    <div class="col-md-4 hideOnTablet">
        <div class="dashboardSection nextWeekGames" data-load="/nextWeekGames">
            @include('dashboard.nextWeekGames')
        </div>
    </div>
</div>

<script>
    $this = $('.dashboard');

    // var load = $("[data-load]");
    // $.each(load, function(){
    //     var $this = $(this);
    //     var url = $this.data("load");
    //     $.ajax({
    //         url: url,
    //         beforeSend: function() {
    //             $(this).spinner({ target : $this });
    //         },
    //     }).done(function(data){
    //         $this.html(data);
    //         var links = $this.find("[data-role-ajax]");
    //         $this.pageControl(links);
    //     });
    // });

    if ($(document).width() > 768) {
        $this.find(".dashboardSection").on("mouseover", function(){
            $(this).css({"opacity":"0.95", "background-color":"rgba(0, 0, 0, 1)", "transition" : "opacity .2s ease-in"});
            // $("body").css("overflow", "hidden");
        });
        $this.find(".dashboardSection").on("mouseout", function(){
            $(this).css({"opacity":"0.80", "background-color":"rgba(0, 0, 0, 0.75)", "transition": "opacity .2s ease-out"});
            // $("body").css("overflow", "auto");
        });
    } else {
        $(".dashboardSection").css({"opacity":"0.95", "background-color":"rgba(0, 0, 0, 1)"});
    }
</script>
