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

    public function getGamesForWeek($weekNo)
    {
        $gamesForWeek = Games::select(DB::raw('games.*, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join(DB::raw('teams home_team'), 'home_team.name', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.name', '=', 'games.away')
        ->where('games.week', '=', $weekNo)
        ->orderBy('games.date_for_week', 'ASC')
        ->orderBy('games.time', 'ASC')
        ->orderBy('games.id', 'ASC')
        ->get();
        return $gamesForWeek;
    }

    public function getMyCurrentGames($currentWeekNo, $user)
    {
        $myCurrentGames = Games::select(DB::raw('games.*, selections.*, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join(DB::raw('teams home_team'), 'home_team.name', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.name', '=', 'games.away')
        ->join('selections', 'games.id', '=', 'selections.game_id')
        ->where('selections.user_id', "=", $user->id)
        ->where('games.week', '=', $currentWeekNo)
        ->groupBy('selections.game_id')
        ->orderBy('games.date_for_week', 'ASC')
        ->orderBy('games.time', 'ASC')
        ->orderBy('games.id', 'ASC')
        ->get();
        return $myCurrentGames;
    }

    public function getNextWeekGames($nextWeekNo)
    {
        $nextWeekGames = Games::select(DB::raw('games.*, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join(DB::raw('teams home_team'), 'home_team.name', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.name', '=', 'games.away')
        ->where('games.week', '=', $nextWeekNo)
        ->orderBy('games.date_for_week', 'ASC')
        ->orderBy('games.time', 'ASC')
        ->orderBy('games.id', 'ASC')
        ->get();
        return $nextWeekGames;
    }

    public function getLastWeekResults($lastWeekNo)
    {
        $lastWeekResults = Games::select(DB::raw('games.*, winnings.winning_user, winnings.game_id, users.first_name, users.id, users.last_name, users.avatar, users.username, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join(DB::raw('teams home_team'), 'home_team.name', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.name', '=', 'games.away')
        ->join('winnings', 'games.id', '=', 'winnings.game_id')
        ->join('users', 'winnings.winning_user', '=', 'users.id')
        ->where('games.week', '=', $lastWeekNo)
        ->orderBy('games.date_for_week', 'ASC')
        ->orderBy('games.time', 'ASC')
        ->orderBy('games.id', 'ASC')
        ->get();
        return $lastWeekResults;
    }

    public function getDatesOfGames($weekNo)
    {
        $dateOfGames = Games::select('date_for_week')->where('week', '=', $weekNo)->groupBy('date_for_week')->get();
        return $dateOfGames;
    }

    public function dashboard()
    {
        $data = [];

        $user = \Auth::user();
        $data['user'] = $user;

        $gamesUserIsPlaying = Selections::where('user_id', "=", $user->id)->groupBy("game_id")->get();
        $data['gamesUserIsPlaying'] = $gamesUserIsPlaying;
        $playingIn = [];
        foreach ($gamesUserIsPlaying as $game) {
            $playingIn[] =  "$game->game_id";
        }
        $data['playingIn'] = $playingIn;

        // Games for the Week
        $gamesForWeek = $this->getGamesForWeek($this->currentWeek);
        $data['gamesForWeek'] = $gamesForWeek;
        $hasGamesForWeek = count($gamesForWeek) > 0;
        $data['hasGamesForWeek'] = $hasGamesForWeek;
        $datesOfCurrentWeekGames = $this->getDatesOfGames($this->currentWeek);
        $data['datesOfCurrentWeekGames'] = $datesOfCurrentWeekGames;

        // My Current Games
        $myCurrentGames = $this->getMyCurrentGames($this->currentWeek, $user);
        $data['myCurrentGames'] = $myCurrentGames;
        $hasCurrentGames = count($myCurrentGames) > 0;
        $data['hasCurrentGames'] = $hasCurrentGames;

        // Upcoming Games
        $nextWeekGames = $this->getNextWeekGames($this->nextWeek);
        $data['nextWeekGames'] = $nextWeekGames;
        $hasNextWeekGames = count($nextWeekGames) > 0;
        $data['hasNextWeekGames'] = $hasNextWeekGames;
        $datesOfNextWeekGames = $this->getDatesOfGames($this->nextWeek);
        $data['datesOfNextWeekGames'] = $datesOfNextWeekGames;

        // Last Week's Results
        $lastWeekResults = $this->getLastWeekResults($this->lastWeek);
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
