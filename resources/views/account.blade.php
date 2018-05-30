@extends('layouts.master')
@section('content')
<style type="text/css">
    @media (max-width:1200px) {
        h3 {
            font-size: 20px;
        }
    }
    .dashboard .col-md-7, .dashboard .col-md-5 {
        height: calc(50vh - 70px);
    }
    .dashboard .col-md-4 {
        height: calc(50vh - 102px);
    }
    .dashboardSection {
        border:1px solid #555;
        height: 100%;
        padding: 5px 10px;
        background-color: rgba(0, 0, 0, .75);
        opacity: 0.80
    }
    .dashboardSection>h3 {
        margin-top: 10px;
    }
    .dashboardSection h4 {
        margin: 0px;
    }
    .dashboardSection .dateOfGame {
        position: sticky;
        top: 0px;
        background-color: #000;
        z-index: 1;
        padding-bottom: 5px;
    }
    .dashboardSection .gamesForWeekTables:not(:last-child) {
        margin-bottom: 10px;
    }
    .dashboardSection .playGameBtn {
        width: 85%;
    }
    .dashboard .dashboardSection .table-header {
        position: sticky;
        top:0px;
        height: auto!important;
        margin-bottom: 0px;
    }
    .dashboardSection>#no-more-tables {
        overflow: auto;
        width: 100%;
        height: calc(100% - 55px);
    }

    .dashboard .startPlayingBtn {
        border:1px solid #000;
        font-size: 20px;
        padding: 15px 30px;
    }
    .dashboard #startPlayingBtn {
        margin-top: 40px;
        /*margin-top: 25px;*/
    }
    @media (max-width: 991px) {
        [class^="col-md-"] {
            margin-bottom: 20px;
        }
        .row {
            padding-top: 0px!important;
        }
    }
    @media(max-width: 700px){
        .dashboard .col-md-7, .dashboard .col-md-5, .dashboard .col-md-4 {
            overflow: auto;
            height: 60vh;
        }
        .dashboardSection #playGameBtn {
            padding: 5px!important;
        }
        .dashboardSection .playGameBtn {
            width: 100%;
        }

        .dashboardSection h4 {
            text-align: center;
        }
        .gameTeams .pull-left, .gameTeams .pull-right {
            float: none !important;
            display: inline-block;
        }
        .gameTeams .homeTeam {
            margin-bottom: 10px;
        }
        .gameTeams .width50 {
            /* width: unset !important; */
            width: 49% !important;
        }
        .absolute {
            position: unset !important;
        }
        .width25 {
            width: unset !important;
        }
        .dashboardSection #availablePicks {
            width: 100%!important;
        }
        .dashboardSection #availablePicksBar {
            height: 20px!important;
        }
        .dashboardSection #availablePicksLabel {
            font-size: 16px !important;
            margin: 2px auto !important;
            top: 38px!important;
            text-align: center;
        }
        .dashboardSection #no-more-tables td {
            padding-left: 40%;
        }
    }
    .dashboardSection a:hover {
        text-decoration: none;
    }
    .dashboardSection.lastWeekResults .scores {
        text-align:left;
        vertical-align: middle;
        display: inline-flex;
        min-width: 30px;
    }
    .dashboardSection #availablePicks {
        width: 85%;
        margin: 0 auto;
        background-color: grey;
        border-radius: 10px;
    }
    .dashboardSection #availablePicksBar {
        height: 12px;
        margin-top: 3px;
        background-color: green;
        border-radius: 10px;
    }
    .dashboardSection #availablePicksLabel {
        font-size: 12px;
        position: absolute;
        margin: 0 auto;
        width: 100%;
        top: 0px;
    }
    h4.dateOfGame small {
        color: inherit!important;
    }
    .col-sm-12 {
        width: 100%;
    }
    @media (min-width: 992px){

        .dashboardSection .playGameBtn {
            width: 90%;
            padding: 5px 3px;
        }
    }
</style>

<!-- Dashboard -->
<div class="dashboard activeSection text-center" style="display:none">
    <div class="row">
        <!-- Games For The Week -->
        <div class="col-md-7">
            <div class="dashboardSection gamesForWeek">
                @include('dashboard.gamesForWeek')
            </div>
        </div>
        <!-- My Current Games -->
        <div class="col-md-5">
            <div class="dashboardSection myCurrentGames">
                @include('dashboard.myCurrentGames')
            </div>
        </div>
    </div>
    <div class="row padding-t-30">
        <!-- Last Week's Results -->
        <div class="col-md-4">
            <div class="dashboardSection lastWeekResults">
                @include('dashboard.lastWeekResults')
            </div>
        </div>
        <!-- Leaderboard -->
        <div class="col-md-4">
            <div class="dashboardSection leaderboard">
                @include('dashboard.leaderboard')
            </div>
        </div>
        <!-- Next Week's Games -->
        <div class="col-md-4">
            <div class="dashboardSection nextWeekGames">
                @include('dashboard.nextWeekGames')
            </div>
        </div>
    </div>
</div>
@stop
