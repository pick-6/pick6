<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Http\Controllers\RandNums;
use App\Models\Games;
use App\Models\Teams;
use App\Models\Selections;
use App\Models\Winnings;
use App\User;
use Carbon\Carbon;
use DB;

class GamesController extends Controller
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
        $games = Games::select(DB::raw('games.*, home_team.name as home, away_team.name as away, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join(DB::raw('teams home_team'), 'home_team.id', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.id', '=', 'games.away')
        ->where('games.season_type', '=', $this->season_type)
        ->where('games.week', '=', $this->currentWeek)
        ->orderBy('games.time', 'ASC')
        ->get();
        $data['games'] = $games;
        $dates = Games::groupBy('date_for_week')->where('games.season_type', '=', $this->season_type)->get();
        $data['dates'] = $dates;
        $currentWeek = $this->currentWeek;
        $data['currentWeek'] = $currentWeek;
        $playingIn = [];
        $gamesUserIsPlaying = Selections::where('user_id', "=", $user->id)->groupBy("game_id")->get();
        foreach ($gamesUserIsPlaying as $game) {
            $playingIn[] =  "$game->game_id";
        }
        $data['playingIn'] = $playingIn;

        return view('game.playGame')->with($data);
    }

    public function show(Request $request, $id)
    {
        $data = [];

        $user = \Auth::user();

        $thisGame = Games::select(DB::raw('games.*, home_team.name as home, away_team.name as away, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join(DB::raw('teams home_team'), 'home_team.id', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.id', '=', 'games.away')
        ->where('games.season_type', '=', $this->season_type)
        // ->where('games.week', '=', $this->currentWeek) //to only pick in games in current week
        ->where('games.id', '=', $id)
        ->get();
        $data['thisGame'] = $thisGame;
        if (count($thisGame) < 1) {
            abort(404);
        }

        $gameOver = $this->gameOverCheck($id);
        $data['gameOver'] = $gameOver;

        $currentWeek = $this->currentWeek;
        $data['currentWeek'] = $currentWeek;

        $allGames = Games::select(DB::raw('games.*, home_team.name as home, away_team.name as away, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join(DB::raw('teams home_team'), 'home_team.id', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.id', '=', 'games.away')
        ->where('games.season_type', '=', $this->season_type)
        ->where('games.week', '=', $this->currentWeek)
        ->orderBy('games.time', 'ASC')
        ->get();
        $data['allGames'] = $allGames;

        if ($gameOver)
        {
            $gameWinnings = Winnings::select('*')->where('game_id', '=', $id)->get();
            $data['gameWinnings'] = $gameWinnings;

            $hasWinnings = boolval(count($gameWinnings) < 1) ? false : true;
            $data['hasWinnings'] = $hasWinnings;

            if ($hasWinnings) {
                if (is_null($gameWinnings[0]['winning_user'])) {
                    $data['hasWinningUser'] = false;
                } else {
                    $data['hasWinningUser'] = true;
                }
            }

            $winningUser = Winnings::select(DB::raw('winning_user, users.*'))->join('users', 'winning_user', '=', 'users.id')->where('game_id', '=', $id)->get();
            $data['winningUser'] = $winningUser;
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

        $dates = Games::groupBy('date_for_week')->where('games.season_type', '=', $this->season_type)->get();
        $data['dates'] = $dates;

        $playingIn = [];
        $gamesUserIsPlaying = Selections::where('user_id', "=", $user->id)->groupBy("game_id")->get();
        foreach ($gamesUserIsPlaying as $game) {
            $playingIn[] =  "$game->game_id";
        }
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
