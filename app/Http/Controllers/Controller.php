<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // TO DO: get 'week' and 'season_type' numbers dynamically
        $this->season_type = 2;
        $this->currentWeek = 8;

        $this->lastWeek = $this->currentWeek - 1;
        $this->nextWeek = $this->currentWeek + 1;

        $this->isPreSeason = $this->season_type == 1;
        $this->isRegularSeason = $this->season_type == 2;
        $this->isPostSeason = $this->season_type == 3;

        // $this->minGamePicks = 0;
        $this->minGamePicks = 90;
    }
}
