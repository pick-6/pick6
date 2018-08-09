@extends('layouts.master')
@section('content')
<!-- Dashboard -->
<div class="dashboard text-center">
    <div class="dropdown dashDrop margin-bottom-20 showOnTablet">
        <button class="btn btn-secondary dropdown-toggle dashDropBtn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="btnTitle">Games For The Week</span> <i class="fas fa-caret-down"></i>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li class="dropdown-item" data-item="1" data-section="gamesForWeek">
                <span class="inline-block" style="min-width:25px;font-size:1.25em;">
                    <i class="fas fa-calendar-alt"></i>
                </span>
                Games For The Week
            </li>
            <li class="dropdown-item" data-item="2" data-section="myCurrentGames">
                <span class="inline-block" style="min-width:25px;font-size:1.25em;">
                    <i class="fas fa-football-ball"></i>
                </span>
                My Current Games
            </li>
            <li class="dropdown-item" data-item="3" data-section="lastWeekResults">
                <span class="inline-block" style="min-width:25px;font-size:1.25em;">
                    <i class="fas fa-calendar-check"></i>
                </span>
                Last Week's Results
            </li>
            <li class="dropdown-item" data-item="4" data-section="leaderboard">
                <span class="inline-block" style="min-width:25px;font-size:1.25em;">
                    <i class="fas fa-trophy"></i>
                </span>
                Leaderboard
            </li>
            <li class="dropdown-item" data-item="5" data-section="nextWeekGames">
                <span class="inline-block" style="min-width:25px;font-size:1.25em;">
                    <i class="fas fa-calendar-plus"></i>
                </span>
                Next Week's Games
            </li>
        </ul>
    </div>
    <div class="row">
        <!-- Games For The Week -->
        <div class="col-md-7">
            <div class="dashboardSection gamesForWeek">
                @include('dashboard.gamesForWeek')
            </div>
        </div>
        <!-- My Current Games -->
        <div class="col-md-5 hideOnTablet">
            <div class="dashboardSection myCurrentGames">
                @include('dashboard.myCurrentGames')
            </div>
        </div>
    </div>
    <div class="row padding-t-30">
        <!-- Last Week's Results -->
        <div class="col-md-4 hideOnTablet">
            <div class="dashboardSection lastWeekResults">
                @include('dashboard.lastWeekResults')
            </div>
        </div>
        <!-- Leaderboard -->
        <div class="col-md-4 hideOnTablet">
            <div class="dashboardSection leaderboard">
                @include('dashboard.leaderboard')
            </div>
        </div>
        <!-- Next Week's Games -->
        <div class="col-md-4 hideOnTablet">
            <div class="dashboardSection nextWeekGames">
                @include('dashboard.nextWeekGames')
            </div>
        </div>
    </div>
</div>
@stop
