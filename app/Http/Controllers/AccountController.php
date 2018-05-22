<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Games;
use App\Models\Winnings;
use App\Models\Selections;
use App\User;
use Auth;
use Image;
use DB;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    public static function numberOfPicksForGame($game)
    {
        $picks = Selections::select(DB::raw('count(square_selection) AS picks'))
        ->where('game_id', '=', $game)
        ->get();

        $hasPicks = count($picks) > 0;

        if ($hasPicks) {
            $numberOfPicks = $picks[0]['picks'];
            return $numberOfPicks;
        } else {
            $numberOfPicks = 0;
            return $numberOfPicks;
        }
    }

    public function getLeaderBoard()
    {
        $leaderboard = Winnings::select(DB::raw('users.*, count(winning_user) AS wins'))
        ->join('users', 'winning_user', '=', 'users.id')
        ->groupBy('winning_user')
        ->orderBy('wins', 'DESC')
        ->get();
        return $leaderboard;
    }

    public function getGamesForWeek($weekNo)
    {
        $gamesForWeek = Games::select(DB::raw('games.*, date_for_week, time, home, away, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join(DB::raw('teams home_team'), 'home_team.name', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.name', '=', 'games.away')
        ->where('games.week', '=', $weekNo)
        ->orderBy('games.date_for_week', 'ASC')
        ->orderBy('games.time', 'ASC')
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
        ->get();
        return $nextWeekGames;
    }

    public function getLastWeekResults($lastWeekNo)
    {
        $lastWeekResults = Games::select(DB::raw('games.*, winnings.*, username, avatar, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join(DB::raw('teams home_team'), 'home_team.name', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.name', '=', 'games.away')
        ->join('winnings', 'games.id', '=', 'winnings.game_id')
        ->join('users', 'winnings.winning_user', '=', 'users.id')
        ->where('games.week', '=', $lastWeekNo)
        ->orderBy('games.date_for_week', 'ASC')
        ->orderBy('games.time', 'ASC')
        ->get();
        return $lastWeekResults;
    }

    public function dashboard()
    {
        $data = [];

        $user = \Auth::user();
        $data['user'] = $user;

        $dateOfGame = Games::select('date_for_week')->where('week', '=', $this->currentWeek)->groupBy('date_for_week')->get();
        $data['dateOfGame'] = $dateOfGame;
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

        return view('account')->with($data);
    }


    public function create()
    {
        abort(404);
    }


    public function store(Request $request)
    {
        abort(404);
    }


    public function show()
    {
        abort(404);
    }


    public function edit()
    {
        return view('edit');
    }


    public function update(Request $request)
    {
        $existingUser = User::find(\Auth::id());
        $existingUser->first_name = $request->first_name;
        $existingUser->last_name = $request->last_name;
        $existingUser->username = $request->username;
        $existingUser->email = $request->email;
        $existingUser->save();
        $request->session()->flash('successMessage', 'Account updated successfully!');

        return redirect()->action('AccountController@dashboard');
    }

    public function editPassword()
    {
        return view('editPassword');
    }

    public function updatePassword(Request $request)
    {
        $existingUser = User::find(\Auth::id());
        $existingUser->password = bcrypt($request->password);
        $existingUser->save();
        $request->session()->flash('successMessage', 'Password updated successfully!');

        return redirect()->action('AccountController@dashboard');
    }

    public function uploadProfilePic(Request $request)
    {
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/img/profilePics/' . $filename ) );

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        $request->session()->flash('successMessage', 'Profile Image updated successfully!');

        return redirect('/dashboard');
    }

    public function destroy($id)
    {
        abort(404);
    }
}
