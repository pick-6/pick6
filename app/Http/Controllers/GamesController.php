<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Http\Controllers\RandNums;
use \App\Http\Controllers\SelectionsController;
use App\Models\Games;
use App\Models\Teams;
use App\Models\Selections;
use App\Models\Winnings;
use App\User;
use Auth;
use Carbon\Carbon;
use DB;

class GamesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    public static function gamesForWeek($seasonType, $weekNo)
    {
        $games = Games::select(DB::raw('games.*, home_team.city as home_city, home_team.name as home, away_team.city as away_city, away_team.name as away, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join(DB::raw('teams home_team'), 'home_team.id', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.id', '=', 'games.away')
        ->where('games.season_type', '=', $seasonType)
        ->where('games.week', '=', $weekNo)
        ->orderBy('games.date_for_week', 'ASC')
        ->orderBy('games.time', 'ASC')
        ->orderBy('games.id', 'ASC')
        ->get();
        return $games;
    }

    public static function getDatesOfGames($seasonType, $weekNo)
    {
        $dateOfGames = Games::groupBy('date_for_week')
        ->where('games.season_type', '=', $seasonType)
        ->where('week', '=', $weekNo)
        ->get();
        return $dateOfGames;
    }

    public static function getDatesOfMyCurrentGames($userId, $seasonType, $weekNo)
    {
        $dateOfGames = Games::groupBy('date_for_week')
        ->join('selections', 'games.id', '=', 'selections.game_id')
        ->where('selections.user_id', "=", $userId)
        ->where('games.season_type', '=', $seasonType)
        ->where('week', '=', $weekNo)
        ->get();
        return $dateOfGames;
    }

    public static function gamesUserIsPlayingIn($userId)
    {
        $playingIn = [];
        $gamesUserIsPlaying = Selections::where('user_id', "=", $userId)->groupBy("game_id")->get();
        foreach ($gamesUserIsPlaying as $game) {
            $playingIn[] =  "$game->game_id";
        }
        return $playingIn;
    }

    public static function getAllMyGames($userId)
    {
        $myGames = Games::select(DB::raw('games.*, selections.*'))
        ->join('selections', 'games.id', '=', 'selections.game_id')
        ->where('selections.user_id', "=", $userId)
        ->groupBy('selections.game_id')
        ->orderBy('games.date_for_week', 'ASC')
        ->orderBy('games.time', 'ASC')
        ->orderBy('games.id', 'ASC')
        ->get();
        return $myGames;
    }

    public static function getMyCurrentGames($userId, $seasonType, $weekNo)
    {
        $myCurrentGames = Games::select(DB::raw('games.*, selections.*, home_team.city as home_city, home_team.name as home, away_team.city as away_city, away_team.name as away, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join(DB::raw('teams home_team'), 'home_team.id', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.id', '=', 'games.away')
        ->join('selections', 'games.id', '=', 'selections.game_id')
        ->where('selections.user_id', "=", $userId)
        ->where('games.season_type', '=', $seasonType)
        ->where('games.week', '=', $weekNo)
        ->groupBy('selections.game_id')
        ->orderBy('games.date_for_week', 'ASC')
        ->orderBy('games.time', 'ASC')
        ->orderBy('games.id', 'ASC')
        ->get();
        return $myCurrentGames;
    }

    public static function getWeekResults($weekNo, $seasonType)
    {
        if ($weekNo == 0 && $seasonType > 1) {
            $seasonType = $seasonType - 1;
            $week = Games::select('week')
            ->distinct()
            ->where('season_type', '=', $seasonType)
            ->orderBy('week', 'DESC')
            ->limit(1)
            ->get();
            $weekNo = $week[0]['week'];
        }

        $weekResults = Games::select(DB::raw('games.*, home_team.city as home_city, home_team.name as home, away_team.city as away_city, away_team.name as away, winnings.winning_user, winnings.game_id, concat(users.first_name, " " ,users.last_name) AS full_name, users.id, users.avatar, users.username, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join(DB::raw('teams home_team'), 'home_team.id', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.id', '=', 'games.away')
        ->join('winnings', 'games.id', '=', 'winnings.game_id')
        ->join('users', 'winnings.winning_user', '=', 'users.id')
        ->where('games.season_type', '=', $seasonType)
        ->where('games.week', '=', $weekNo)
        ->orderBy('games.date_for_week', 'ASC')
        ->orderBy('games.time', 'ASC')
        ->orderBy('games.id', 'ASC')
        ->get();
        return $weekResults;
    }

    public static function getLeaderBoard()
    {
        $leaderboard = Winnings::select(DB::raw('users.id, concat(first_name, " " ,last_name) AS full_name, username, email, avatar, count(winning_user) AS wins'))
        ->join('users', 'winning_user', '=', 'users.id')
        ->groupBy('winning_user')
        ->orderBy('wins', 'DESC')
        ->orderBy('users.last_name', 'ASC')
        ->get();
        return $leaderboard;
    }

    public function index()
    {
        $data = [];

        $userId = \Auth::id();

        $currentWeek = $this->currentWeek;
        $data['currentWeek'] = $currentWeek;
        $seasonType = $this->season_type;
        $data['season_type'] = $seasonType;

        $gamesForWeek = $this->gamesForWeek($seasonType, $currentWeek);
        $data['gamesForWeek'] = $gamesForWeek;

        $dates = $this->getDatesOfGames($seasonType, $currentWeek);
        $data['datesOfCurrentWeekGames'] = $dates;

        $playingIn = $this->gamesUserIsPlayingIn($userId);
        $data['playingIn'] = $playingIn;

        $minGamePicks = $this->minGamePicks;
        $data['minGamePicks'] = $minGamePicks;

        return view('game.gamesForWeekList')->with($data);
    }

    public function show(Request $request, $id)
    {
        $data = [];

        $user = \Auth::user();

        $currentWeek = $this->currentWeek;
        $data['currentWeek'] = $currentWeek;
        $seasonType = $this->season_type;
        $data['seasonType'] = $seasonType;

        $thisGame = Games::select(DB::raw('games.*, home_team.city as home_city, home_team.name as home, away_team.city as away_city, away_team.name as away, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join(DB::raw('teams home_team'), 'home_team.id', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.id', '=', 'games.away')
        ->where('games.id', '=', $id)
        ->get();
        $data['thisGame'] = $thisGame;
        if (count($thisGame) < 1) {
            abort(404);
        }

        $gameOver = $this->gameOverCheck($id);
        $data['gameOver'] = $gameOver;
        $data['isOver'] = boolval($gameOver) ? 'true' : 'false';

        $gamesForWeek = $this->gamesForWeek($seasonType, $currentWeek);
        $data['gamesForWeek'] = $gamesForWeek;

        $datesForWeek = $this->getDatesOfGames($seasonType, $currentWeek);
        $data['datesForWeek'] = $datesForWeek;

        if ($gameOver)
        {
            $gameWinnings = Winnings::select('*')->where('game_id', '=', $id)->get();
            $data['gameWinnings'] = $gameWinnings;

            $hasWinnings = boolval(count($gameWinnings) < 1) ? false : true;
            $data['hasWinnings'] = $hasWinnings;

            $winningSelection = Games::getWinningScore($id);
            $data['winningSelection'] = $winningSelection;

            if ($hasWinnings) {
                $winningUser = Winnings::select(DB::raw('winning_user, users.*'))->join('users', 'winning_user', '=', 'users.id')->where('game_id', '=', $id)->get();
                $data['winningUser'] = $winningUser;

                $hasWinningUser = boolval(count($winningUser) < 1) ? false : true;
                $data['hasWinningUser'] = $hasWinningUser;

                if($hasWinningUser){
                    $winningUserId = $gameWinnings[0]['winning_user'];
                    $data['winningUserId'] = $winningUserId;
                    $winningUserFullName = $winningUser[0]['first_name'] . " " .$winningUser[0]['last_name'];
                    $data['winningUserFullName'] = $winningUserFullName;
                }

                $winningTotal = $gameWinnings[0]['winning_total'];
                $data['winningTotal'] = $winningTotal;
                $total = str_replace(".00","",money_format('$%i',$winningTotal));
                $data['total'] = $total;
            }
        }

        $squaresSelected = Selections::select('*')
        ->join('users', 'selections.user_id', '=', 'users.id')
        ->where('game_id', '=', $id)
        ->get();
        $data['squaresSelected'] = $squaresSelected;

        $thisGameSelections = [];
        foreach ($squaresSelected as $squareSelected) {
            $thisGameSelections[] =  "$squareSelected->square_selection";
        }
        $data['thisGameSelections'] = $thisGameSelections;

        $dates = Games::groupBy('date_for_week')->where('games.season_type', '=', $seasonType)->get();
        $data['datesOfCurrentWeekGames'] = $dates;

        $playingIn = $this->gamesUserIsPlayingIn($user->id);
        $data['playingIn'] = $playingIn;

        $cost = Games::select('pick_cost')->where('id', '=', $id)->get();
        $pickCost = $cost[0]['pick_cost'];
        $data['pickCost'] = $pickCost;

        $creditForUser = User::select('credit')->where('id', '=', $user->id)->get();
        $userCredit = $creditForUser[0]['credit'];
        $data['userCredit'] = $userCredit;

        $moneySpent = Selections::select(DB::raw('count(square_selection)*games.pick_cost as moneySpent'))
        ->join('games', 'selections.game_id', '=', 'games.id')
        ->where('user_id', '=', $user->id)
        ->where('game_id', '=', $id)
        ->get();
        $moneyInGame = $moneySpent[0]['moneySpent'];
        $data['moneyInGame'] = money_format('$%i', $moneyInGame);

        $gamePot = Selections::select(DB::raw('count(square_selection)*games.pick_cost as pot'))
        ->join('games', 'selections.game_id', '=', 'games.id')
        ->where('game_id', '=', $id)
        ->get();
        $potAmount = $gamePot[0]['pot'];
        $data['potAmount'] = money_format('$%i', $potAmount);

        $potentialEarnings = $potAmount - $moneyInGame;
        $data['potentialEarnings'] = money_format('$%i', $potentialEarnings);

        $gameTime = $thisGame[0]['date_for_week'] . ' ' . $thisGame[0]['time'];
        $gameStarted = $gameTime <= Carbon::now('America/New_York');
        $data['gameStarted'] = boolval($gameStarted) ? 'true' : 'false';
        if($gameStarted) {
            // $randomNumbers = $this->getRandomNumbers();
            $randomNumbers = RandNums::getRandomNumbers($id);
            $data['randomNumbers'] = $randomNumbers;
        }

        $numberOfPicks = $this->numberOfPicksForGame($id);
        $data['numberOfPicks'] = $numberOfPicks;

        $gameCancel = $numberOfPicks < $this->minGamePicks && $gameStarted;
        $data['gameCancel'] = $gameCancel;
        $data['isCancelled'] = boolval($gameCancel) ? 'true' : 'false';

        $minGamePicks = $this->minGamePicks;
        $data['minGamePicks'] = $minGamePicks;

        $creditForUser = User::select('credit')->where('id', '=', Auth::id())->get();
        $credit = $creditForUser[0]['credit'];
        $data['credit'] = $credit;
        $creditAmount = money_format('$%i', $credit);
        $data['creditAmount'] = $creditAmount;

        $gameId = $thisGame[0]['id'];
        $data['gameId'] = $gameId;
        $homeTeam = $thisGame[0]['home_city']." ".$thisGame[0]['home'];
        $data['homeTeam'] = $homeTeam;
        $awayTeam = $thisGame[0]['away_city']." ".$thisGame[0]['away'];
        $data['awayTeam'] = $awayTeam;
        $homeLogo = $thisGame[0]['home_logo'];
        $data['homeLogo'] = $homeLogo;
        $awayLogo = $thisGame[0]['away_logo'];
        $data['awayLogo'] = $awayLogo;
        $homeScore = $thisGame[0]['home_score'];
        $data['homeScore'] = $homeScore;
        $awayScore = $thisGame[0]['away_score'];
        $data['awayScore'] = $awayScore;

        $data['homeScoreDigit'] = substr($homeScore, -1);
        $data['awayScoreDigit'] = substr($awayScore, -1);

        return view('game.showGame')->with($data);
    }

    public static function numberOfPicksForGame($game)
    {
        $picks = Selections::select(DB::raw('count(square_selection) AS picks'))
        ->where('game_id', '=', $game)
        ->get();

        $hasPicks = count($picks) > 0;

        if ($hasPicks) {
            $numberOfPicks = $picks[0]['picks'];
        } else {
            $numberOfPicks = 0;
        }

        return $numberOfPicks;
    }

    public function getRandomNumbers()
    {
        $data = [];

        $home_numbers = range(0,9);
        shuffle($home_numbers);
        $home = array_slice($home_numbers, 0,10);
        $data['home'] = $home;

        $away_numbers = range(0,9);
        shuffle($away_numbers);
        $away = array_slice($away_numbers, 0,10);
        $data['away'] = $away;

        return $data;
    }

    public function gameOverCheck($gameId)
    {
        $game = Games::select('*')->where('id', '=', $gameId)->first();
        $isGameOver = !is_null($game->home_score) || !is_null($game->away_score);
        return $isGameOver;
    }
}
