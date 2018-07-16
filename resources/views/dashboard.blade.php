@extends('layouts.master')
@section('content')
<!-- Dashboard -->
<div class="dashboard text-center">
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
