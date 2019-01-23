<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->isAdmin = Auth::user()->email == 'mattvaldez01@gmail.com';
        $this->current_season = 1;
        // TO DO: get 'week' and 'season_type' numbers dynamically
        $this->season_type = 3;
        $this->currentWeek = 4;

        $this->lastWeek = $this->currentWeek - 1;
        $this->nextWeek = $this->currentWeek + 1;

        $this->isPreSeason = $this->season_type == 1;
        $this->isRegularSeason = $this->season_type == 2;
        $this->isPostSeason = $this->season_type == 3;

        // $this->minGamePicks = 0;
        $this->minGamePicks = 90;

        $postSeasonTitle = "";
        switch ($this->currentWeek) {
            case 1:
                $postSeasonTitle = "WILD CARD WEEKEND";
                break;
            case 2:
                $postSeasonTitle = "DIVISIONAL PLAYOFFS";
                break;
            case 3:
                $postSeasonTitle = "CONFERENCE CHAMPIONSHIPS";
                break;
            case 4:
                $postSeasonTitle = "PRO BOWL";
                break;
            case 5:
                $postSeasonTitle = "SUPER BOWL";
                break;
        }
        $this->postSeasonTitle = $postSeasonTitle;
    }
}
