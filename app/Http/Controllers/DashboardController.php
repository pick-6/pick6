<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Games;
use App\Models\Winnings;
use App\Models\Selections;
use App\User;
use Auth;
use DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    public function index()
    {
        $data = [];

        $user = \Auth::user();
        $data['user'] = $user;
        $isAdmin = $this->isAdmin;
        $data['isAdmin'] = $isAdmin;
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

        $currentSeason = $this->current_season;
        $data['currentSeason'] = $currentSeason;

        $isPreSeason = $this->isPreSeason;
        $data['isPreSeason'] = $isPreSeason;
        $isRegularSeason = $this->isRegularSeason;
        $data['isRegularSeason'] = $isRegularSeason;
        $isPostSeason = $this->isPostSeason;
        $data['isPostSeason'] = $isPostSeason;

        $minGamePicks = $this->minGamePicks;
        $data['minGamePicks'] = $minGamePicks;

        $gamesAreFree = $this->gamesAreFree;
        $data['gamesAreFree'] = $gamesAreFree;

        // Games for the Week
        $gamesForWeek = GamesController::gamesForWeek($seasonType, $currentWeek, $currentSeason);
        $data['gamesForWeek'] = $gamesForWeek;
        $hasGamesForWeek = count($gamesForWeek) > 0;
        $data['hasGamesForWeek'] = $hasGamesForWeek;
        $datesOfCurrentWeekGames = GamesController::getDatesOfGames($seasonType, $currentWeek, $currentSeason);
        $data['datesOfCurrentWeekGames'] = $datesOfCurrentWeekGames;
        if ($isPostSeason) {
            $data['gamesForWeekTitle'] = $this->postSeasonTitle;
        } else if ($isPreSeason) {
            $data['gamesForWeekTitle'] = "Games - Week $currentWeek";
        } else {
            $data['gamesForWeekTitle'] = "Games for Week $currentWeek";
        }

        // My Current Games
        $myCurrentGames = GamesController::getMyCurrentGames($user->id, $seasonType, $currentWeek, $currentSeason);
        $data['myCurrentGames'] = $myCurrentGames;
        $hasCurrentGames = count($myCurrentGames) > 0;
        $data['hasCurrentGames'] = $hasCurrentGames;
        $datesOfMyCurrentGames = GamesController::getDatesOfMyCurrentGames($user->id, $seasonType, $currentWeek, $currentSeason);
        $data['datesOfMyCurrentGames'] = $datesOfMyCurrentGames;
        $data['myCurrentGamesTitle'] = "My Current Games";

        // Next Week's Games
        $nextWeekGames = GamesController::gamesForWeek($seasonType, $nextWeek, $currentSeason);
        $data['nextWeekGames'] = $nextWeekGames;
        $hasNextWeekGames = count($nextWeekGames) > 0;
        $data['hasNextWeekGames'] = $hasNextWeekGames;
        $datesOfNextWeekGames = GamesController::getDatesOfGames($seasonType, $nextWeek, $currentSeason);
        $data['datesOfNextWeekGames'] = $datesOfNextWeekGames;
        $data['nextWeekGamesTitle'] = "Next Week's Games";

        // Last Week's Results
        $lastWeekResults = GamesController::getWeekResults($lastWeek, $seasonType, $currentSeason);
        $data['lastWeekResults'] = $lastWeekResults;
        $hasLastWkGames = count($lastWeekResults) > 0 ;
        $data['hasLastWkGames'] = $hasLastWkGames;
        $data['lastWeekResultsTitle'] = "Last Week's Results";

        // Leaderboard
        $leaderboard = GamesController::getLeaderBoard();
        $data['leaderboard'] = $leaderboard;
        $hasLeaders = count($leaderboard) > 0 ;
        $data['hasLeaders'] = $hasLeaders;
        $data['leaderboardTitle'] = "Leaderboard";

        $totalWinnings = Winnings::select(DB::raw('sum(winning_total) AS winnings'))->where('winning_user', '=', Auth::id())->get();
        $data['totalWinnings'] = str_replace(".00","",money_format('$%i', $totalWinnings[0]['winnings']));
        $hasWinnings = $totalWinnings[0]['winnings'] > 0;
        $data['hasWinnings'] = $hasWinnings;

        $favoriteTeam = User::select(DB::raw('users.fav_team, teams.*'))
        ->join('teams', 'teams.id', '=', 'users.fav_team')
        ->where('users.id', '=', Auth::id())
        ->get();
        $data['favoriteTeam'] = $favoriteTeam;
        $hasFavTeam = count($favoriteTeam) > 0;
        $data['hasFavTeam'] = $hasFavTeam;

        $data['isLoggedInUser'] = true;

        $allTeams = DB::table('teams')
        ->where('teams.id', '!=', 33)
        ->where('teams.id', '!=', 34)
        ->where('teams.id', '!=', 35)
        ->get();
        $data['allTeams'] = $allTeams;

        return view('dashboard')->with($data);
    }

    public function getGamesForWeekView(Request $request)
    {
        $data = [];

        $seasonType = $this->season_type;
        $currentWeek = $this->currentWeek;
        $currentSeason = $this->current_season;
        $isAdmin = $this->isAdmin;
        $data['isAdmin'] = $isAdmin;

        $gamesAreFree = $this->gamesAreFree;
        $data['gamesAreFree'] = $gamesAreFree;

        $gamesForWeek = GamesController::gamesForWeek($seasonType, $currentWeek, $currentSeason);
        $data['gamesForWeek'] = $gamesForWeek;
        $hasGamesForWeek = count($gamesForWeek) > 0;
        $data['hasGamesForWeek'] = $hasGamesForWeek;
        $datesOfCurrentWeekGames = GamesController::getDatesOfGames($seasonType, $currentWeek, $currentSeason);
        $data['datesOfCurrentWeekGames'] = $datesOfCurrentWeekGames;

        $isPreSeason = $this->isPreSeason;
        $data['isPreSeason'] = $isPreSeason;
        $isRegularSeason = $this->isRegularSeason;
        $data['isRegularSeason'] = $isRegularSeason;
        $isPostSeason = $this->isPostSeason;
        $data['isPostSeason'] = $isPostSeason;
        if ($isPostSeason) {
            $data['title'] = $this->postSeasonTitle;
        } else if ($isPreSeason) {
            $data['title'] = "Games - Week $currentWeek";
        } else {
            $data['title'] = "Games for Week $currentWeek";
        }

        $minGamePicks = $this->minGamePicks;
        $data['minGamePicks'] = $minGamePicks;

        $includeTitle = $request->includeTitle ?? true;
        $data['includeTitle'] = $includeTitle;

        $playingIn = GamesController::gamesUserIsPlayingIn(Auth::id());
        $data['playingIn'] = $playingIn;

        return view('dashboard.gamesForWeek')->with($data);
    }

    public function getMyCurrentGamesView(Request $request)
    {
        $data = [];

        $seasonType = $this->season_type;
        $currentWeek = $this->currentWeek;
        $currentSeason = $this->current_season;
        $userId = $request->userId;
        $isAdmin = $this->isAdmin;
        $data['isAdmin'] = $isAdmin;
        $isLoggedInUser = $userId == Auth::id();
        $data['isLoggedInUser'] = $isLoggedInUser;

        $gamesAreFree = $this->gamesAreFree;
        $data['gamesAreFree'] = $gamesAreFree;

        $user = User::select('*')->where('id', '=', $userId)->get();
        if (count($user) < 1) {
            abort(404);
        }
        $usersFirstName = $user[0]['first_name'];
        $data['first_name'] = $usersFirstName;

        $myCurrentGames = GamesController::getMyCurrentGames($userId, $seasonType, $currentWeek, $currentSeason);
        $data['myCurrentGames'] = $myCurrentGames;
        $hasCurrentGames = count($myCurrentGames) > 0;
        $data['hasCurrentGames'] = $hasCurrentGames;
        $datesOfMyCurrentGames = GamesController::getDatesOfMyCurrentGames($userId, $seasonType, $currentWeek, $currentSeason);
        $data['datesOfMyCurrentGames'] = $datesOfMyCurrentGames;

        $minGamePicks = $this->minGamePicks;
        $data['minGamePicks'] = $minGamePicks;

        $includeTitle = $request->includeTitle ?? true;
        $data['includeTitle'] = $includeTitle;
        $data['title'] = "My Current Games";

        $showGameTime = $request->showGameTime ?? false;
        $data['showGameTime'] = $showGameTime;

        $showPicksAvail = $request->showPicksAvail ?? false;
        $data['showPicksAvail'] = $showPicksAvail;

        $onDash = $request->onDash ?? true;
        $data['onDash'] = $onDash;

        $showCity = $request->showCity ?? false;
        $data['showCity'] = $showCity;

        $playingIn = GamesController::gamesUserIsPlayingIn($userId);
        $data['playingIn'] = $playingIn;

        return view('dashboard.myCurrentGames')->with($data);
    }

    public function getNextWeekGamesView(Request $request)
    {
        $data = [];

        $seasonType = $this->season_type;
        $nextWeek = $this->nextWeek;
        $currentSeason = $this->current_season;
        $isAdmin = $this->isAdmin;
        $data['isAdmin'] = $isAdmin;

        $gamesAreFree = $this->gamesAreFree;
        $data['gamesAreFree'] = $gamesAreFree;

        $nextWeekGames = GamesController::gamesForWeek($seasonType, $nextWeek, $currentSeason);
        $data['nextWeekGames'] = $nextWeekGames;
        $hasNextWeekGames = count($nextWeekGames) > 0;
        $data['hasNextWeekGames'] = $hasNextWeekGames;
        $datesOfNextWeekGames = GamesController::getDatesOfGames($seasonType, $nextWeek, $currentSeason);
        $data['datesOfNextWeekGames'] = $datesOfNextWeekGames;

        $minGamePicks = $this->minGamePicks;
        $data['minGamePicks'] = $minGamePicks;

        $includeTitle = $request->includeTitle ?? true;
        $data['includeTitle'] = $includeTitle;
        $data['title'] = "Next Week's Games";

        return view('dashboard.nextWeekGames')->with($data);
    }

    public function getLastWeekResultsView(Request $request)
    {
        $data = [];

        $seasonType = $this->season_type;
        $lastWeek = $this->lastWeek;
        $currentSeason = $this->current_season;
        $isAdmin = $this->isAdmin;
        $data['isAdmin'] = $isAdmin;

        $gamesAreFree = $this->gamesAreFree;
        $data['gamesAreFree'] = $gamesAreFree;

        $lastWeekResults = GamesController::getWeekResults($lastWeek, $seasonType, $currentSeason);
        $data['lastWeekResults'] = $lastWeekResults;
        $hasLastWkGames = count($lastWeekResults) > 0 ;
        $data['hasLastWkGames'] = $hasLastWkGames;

        $minGamePicks = $this->minGamePicks;
        $data['minGamePicks'] = $minGamePicks;

        $includeTitle = $request->includeTitle ?? true;
        $data['includeTitle'] = $includeTitle;
        $data['title'] = "Last Week's Results";

        return view('dashboard.lastWeekResults')->with($data);
    }

    public function getLeaderboardView(Request $request)
    {
        $data = [];

        $seasonType = $this->season_type;
        $lastWeek = $this->lastWeek;
        $currentSeason = $this->current_season;
        $isAdmin = $this->isAdmin;
        $data['isAdmin'] = $isAdmin;

        $gamesAreFree = $this->gamesAreFree;
        $data['gamesAreFree'] = $gamesAreFree;

        $leaderboard = GamesController::getLeaderBoard($currentSeason);
        $data['leaderboard'] = $leaderboard;
        $hasLeaders = count($leaderboard) > 0 ;
        $data['hasLeaders'] = $hasLeaders;

        $minGamePicks = $this->minGamePicks;
        $data['minGamePicks'] = $minGamePicks;

        $includeTitle = $request->includeTitle ?? true;
        $data['includeTitle'] = $includeTitle;
        $data['title'] = "Leaderboard";

        return view('dashboard.leaderboard')->with($data);
    }
}
