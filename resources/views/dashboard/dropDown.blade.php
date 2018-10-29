<div class="dropdown margin-bottom-20 showOnTablet">
    <button class="btn btn-secondary dropdown-toggle dashDropBtn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="btnTitle">Games For The Week</span> <i class="fas fa-caret-down"></i>
    </button>
    <ul class="dropdown-menu dashDrop" aria-labelledby="dropdownMenuButton">
        <li class="dropdown-item" data-item="1" data-section="gamesForWeek">
            <span class="inline-block" style="min-width:25px;font-size:1.25em;">
                <i class="fas fa-calendar-alt"></i>
            </span>
            <span class="title">
                Games For The Week
            </span>
        </li>
        <li class="dropdown-item" data-item="2" data-section="myCurrentGames">
            <span class="inline-block" style="min-width:25px;font-size:1.25em;">
                <i class="fas fa-football-ball"></i>
            </span>
            <span class="title">
                My Current Games
            </span>
        </li>
        <li class="dropdown-item" data-item="3" data-section="lastWeekResults">
            <span class="inline-block" style="min-width:25px;font-size:1.25em;">
                <i class="fas fa-calendar-check"></i>
            </span>
            <span class="title">
                Last Week's Results
            </span>
        </li>
        <li class="dropdown-item" data-item="4" data-section="leaderboard">
            <span class="inline-block" style="min-width:25px;font-size:1.25em;">
                <i class="fas fa-trophy"></i>
            </span>
            <span class="title">
                Leaderboard
            </span>
        </li>
        <li class="dropdown-item" data-item="5" data-section="nextWeekGames">
            <span class="inline-block" style="min-width:25px;font-size:1.25em;">
                <i class="fas fa-calendar-plus"></i>
            </span>
            <span class="title">
                Next Week's Games
            </span>
        </li>
    </ul>
</div>

<script type="text/javascript">
$('.dashboard').find('.dashDrop').find('.dropdown-item').on('click', function(){
    var title = $(this).find(".title").text().trim();
    var section = $(this).data('section');
    $('.dashboard').find('.dashboardSection').parent().removeClass('showOnTablet').addClass('hideOnTablet');
    $('.dashboard').find('.'+section+'').parent().removeClass('hideOnTablet').addClass('showOnTablet');
    $('.dashboard').find('.dashDropBtn').find('.btnTitle').text(title);
});
$(window).resize(function() {
    if ($(document).width() > 991) {
        $('.dashboard').find('.dashboardSection').parent().removeClass('showOnTablet');
    }
});
</script>
