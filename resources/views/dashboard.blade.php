@extends('layouts.master')
@section('content')
<!-- Dashboard -->
<div class="dashboard text-center">
    @include('dashboard.dropDown')
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
@stop
