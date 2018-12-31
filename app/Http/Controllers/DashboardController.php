<?php

namespace App\Http\Controllers;

use App\Models\Games;
use App\Models\Winnings;
use App\Models\Selections;
use Auth;
use DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    public function getLeaderBoard()
    {
        $leaderboard = Winnings::select(DB::raw('users.id, concat(first_name, " " ,last_name) AS full_name, username, email, avatar, count(winning_user) AS wins'))
        ->join('users', 'winning_user', '=', 'users.id')
        ->groupBy('winning_user')
        ->orderBy('wins', 'DESC')
        ->orderBy('users.last_name', 'ASC')
        ->get();
        return $leaderboard;
    }

    public function dashboard()
    {
        $data = [];

        $user = \Auth::user();
        $data['user'] = $user;

        $playingIn = GamesController::gamesUserIsPlayingIn($user->id);
        $data['playingIn'] = $playingIn;

        $currentWeek = $this->currentWeek;
        $data['currentWeek'] = $currentWeek;
        $lastWeek = $this->lastWeek;
        $data['lastWeek'] = $lastWeek;
        $nextWeek = $this->nextWeek;
        $data['nextWeek'] = $nextWeek;

        $seasonType = $this->season_type;
        $data['seasonType'] = $seasonType;

        $isPreSeason = $this->isPreSeason;
        $data['isPreSeason'] = $isPreSeason;
        $isRegularSeason = $this->isRegularSeason;
        $data['isRegularSeason'] = $isRegularSeason;
        $isPostSeason = $this->isPostSeason;
        $data['isPostSeason'] = $isPostSeason;
        if ($isPostSeason) {
            $data['postSeasonTitle'] = $this->postSeasonTitle;
        }

        $minGamePicks = $this->minGamePicks;
        $data['minGamePicks'] = $minGamePicks;

        // Games for the Week
        $gamesForWeek = GamesController::gamesForWeek($seasonType, $currentWeek);
        $data['gamesForWeek'] = $gamesForWeek;
        $hasGamesForWeek = count($gamesForWeek) > 0;
        $data['hasGamesForWeek'] = $hasGamesForWeek;
        $datesOfCurrentWeekGames = GamesController::getDatesOfGames($seasonType, $currentWeek);
        $data['datesOfCurrentWeekGames'] = $datesOfCurrentWeekGames;

        // My Current Games
        $myCurrentGames = GamesController::getMyCurrentGames($user->id, $seasonType, $currentWeek);
        $data['myCurrentGames'] = $myCurrentGames;
        $hasCurrentGames = count($myCurrentGames) > 0;
        $data['hasCurrentGames'] = $hasCurrentGames;

        // Next Week's Games
        $nextWeekGames = GamesController::gamesForWeek($seasonType, $nextWeek);
        $data['nextWeekGames'] = $nextWeekGames;
        $hasNextWeekGames = count($nextWeekGames) > 0;
        $data['hasNextWeekGames'] = $hasNextWeekGames;
        $datesOfNextWeekGames = GamesController::getDatesOfGames($seasonType, $nextWeek);
        $data['datesOfNextWeekGames'] = $datesOfNextWeekGames;

        // Last Week's Results
        $lastWeekResults = GamesController::getWeekResults($lastWeek, $seasonType);
        $data['lastWeekResults'] = $lastWeekResults;
        $hasLastWkGames = count($lastWeekResults) > 0 ;
        $data['hasLastWkGames'] = $hasLastWkGames;

        // Leaderboard
        $leaderboard = $this->getLeaderBoard();
        $data['leaderboard'] = $leaderboard;
        $hasLeaders = count($leaderboard) > 0 ;
        $data['hasLeaders'] = $hasLeaders;

        return view('dashboard')->with($data);
    }
}
