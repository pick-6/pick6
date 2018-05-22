<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Games;
use App\Models\Teams;
use App\Models\Selections;
use App\Models\Charity;
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
        $user = \Auth::user();
        $games = Games::select(DB::raw('games.id, date_for_week, time, home, away, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join(DB::raw('teams home_team'), 'home_team.name', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.name', '=', 'games.away')
        ->orderBy('games.time', 'ASC')
        ->get();
        $dates = Games::groupBy('date_for_week')->get();
        $currentWeek = $this->currentWeek;
        $playingIn = [];
        $gamesUserIsPlaying = Selections::where('user_id', "=", $user->id)->groupBy("game_id")->get();
        foreach ($gamesUserIsPlaying as $game) {
            $playingIn[] =  "$game->game_id";
        }

        return view('playGame')->with(compact('currentWeek', 'games', 'dates', 'playingIn'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // $games = new Game();
        // $games->home = $request->home;
        // $games->away = $request->away;
        // $games->home_score = $request->home_score;
        // $games->away_score = $request->away_score;

        // $games->save();
        // $request->session()->flash('successMessage', 'Post saved successfully');

        // return redirect()->action('gamessController@show', $games->id);
    }

    public function show(Request $request, $id)
    {
        $user = \Auth::user();

        $thisGame = Games::select(DB::raw('games.*, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join(DB::raw('teams home_team'), 'home_team.name', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.name', '=', 'games.away')
        ->where('games.id', '=', $id)
        ->orderBy('games.time', 'ASC')
        ->get();

        if(!$thisGame) {
            abort(404);
        }

        $gameOver = $this->gameOverCheck($id);
        if($gameOver) {
            $randomNumbers = $this->getRandomNumbers();
        }

        $currentWeek = $this->currentWeek;

        $allGames = Games::select(DB::raw('games.id, week, date_for_week, time, home, away, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join(DB::raw('teams home_team'), 'home_team.name', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.name', '=', 'games.away')
        ->orderBy('games.time', 'ASC')
        ->get();

        $thisGameSelections = [];
        $thisGameUserSelections = [];

        $winningSelection = User::select('*')->join('winnings', 'users.id', '=', 'winnings.winning_user')->where('winnings.game_id', '=', $id)->get();
        $winningCharitySelection = Charity::select('*')->join('winnings', 'charities.id', '=', 'winnings.winning_charity')->where('winnings.game_id', '=', $id)->get();
        // $gameTotalBets = Games::select('*')->where('games.id', '=', $id)->get();

        // $squaresSelected = Selections::where('game_id', '=', $id)->get();
        $squaresSelected = Selections::select('*')
        ->join('users', 'selections.user_id', '=', 'users.id')
        ->where('game_id', '=', $id)
        ->get();
        foreach ($squaresSelected as $squareSelected) {
            $thisGameSelections[] =  "$squareSelected->square_selection";
        }

        return view('showGame')->with(compact('gameOver', 'randomNumbers', 'currentWeek', 'allGames', 'thisGame', 'squaresSelected', 'thisGameSelections', 'winningSelection', 'winningCharitySelection', 'gameTotalBets', 'sumOfDonations'));
    }

    public function getRandomNumbers() {
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

    public function gameOverCheck($gameId) {
        $gameTime = Games::select('date_for_week')->where('id', '=', $gameId)->first();
        $isGameOver = $gameTime->date_for_week < Carbon::now();

        return $isGameOver;
    }

    public function edit($id)
    {
        // $games = Game::find($id);

        // if(!$games) {
        //     Session::flash("errorMessage", "Game not found");
        // }
        // return view('games.edit')->with('games', $games);
    }

    public function update(Request $request, $id)
    {
        // $games = Game::find($id);

        // if(!$games) {
        //     Session::flash("errorMessage", "games not found");
        //     return redirect()->action("GamesController@index");
        // }

        // $games->home = $request->home;
        // $games->away = $request->away;
        // $games->home_score = $request->home_score;
        // $games->away_score = $request->away_score;

        // $games->save();
        // return view('games.show')->with('games', $games);
    }

    public function destroy($id)
    {
       // $games = Game::find($id);
       //  if(!$games) {
       //      Session::flash('errorMessage', "Post not found");
       //      return redirect()->action('GamesController@index');
       //  }
       //  $games->delete();
       //  return redirect()->action('GamesController@index');
    }
}
