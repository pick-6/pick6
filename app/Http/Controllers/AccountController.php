<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Games;
use App\Models\Selections;
use App\User;
use Auth;
use Image;
use DB;

class AccountController extends Controller
{
    private $lastWeek;
    private $currentWeek;
    private $nextWeek;

    public function __construct()
    {
        $this->middleware('auth');
        $this->lastWeek = 1;
        $this->currentWeek = 2;
        $this->nextWeek = 3;
    }

    public function getLeaderBoard()
    {
        $leaderboard = Games::select(DB::raw('winning_user, first_name, last_name, avatar, count(winning_user) AS wins'))
        ->join('users', 'games.winning_user', '=', 'users.id')
        ->groupBy('winning_user')
        ->orderBy(DB::raw('count(winning_user)'), 'DESC')
        ->get();
        return $leaderboard;
    }

    public function getGamesForWeek($weekNo)
    {
        // $gamesForWeek = Games::select(DB::raw('count(distinct square_selection) AS picks, games.id, date_for_week, time, home, away, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        $gamesForWeek = Games::select(DB::raw('games.id, date_for_week, time, home, away, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join(DB::raw('teams home_team'), 'home_team.name', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.name', '=', 'games.away')
        // ->join('selections', 'selections.game_id', '=', 'games.id')->groupBy('game_id')
        ->where('games.week', '=', $weekNo)
        ->orderBy('games.date_for_week', 'ASC')
        ->orderBy('games.time', 'ASC')
        ->get();
        return $gamesForWeek;
    }

    public function getMyCurrentGames($currentWeekNo, $user)
    {
        $myCurrentGames = Selections::select(DB::raw('game_id, home, away, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join('games', 'selections.game_id', '=', 'games.id')
        ->join(DB::raw('teams home_team'), 'home_team.name', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.name', '=', 'games.away')
        ->where('user_id', "=", $user->id)
        ->where('games.week', '=', $currentWeekNo)
        ->groupBy('game_id')
        ->get();
        return $myCurrentGames;
    }

    public function getNextWeekGames($nextWeekNo)
    {
        $nextWeekGames = Games::select(DB::raw('games.id, date_for_week, time, home, away, home_team.logo AS home_logo, away_team.logo AS away_logo'))
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
        $lastWeekResults = Games::select(DB::raw('games.id, avatar, username, home_score, away_score, home, away, home_team.logo AS home_logo, away_team.logo AS away_logo'))
        ->join(DB::raw('teams home_team'), 'home_team.name', '=', 'games.home')
        ->join(DB::raw('teams away_team'), 'away_team.name', '=', 'games.away')
        ->join('users', 'games.winning_user', '=', 'users.id')
        ->where('games.week', '=', $lastWeekNo)
        ->orderBy('games.id', 'ASC')
        ->get();
        return $lastWeekResults;
    }

    // TO DO: get current/last 'week' number dynamically
    public function dashboard()
    {
        $data = [];

        $user = \Auth::user();
        $data['user'] = $user;

        // Games for the Week
        $gamesForWeek = $this->getGamesForWeek($this->currentWeek);
        $data['gamesForWeek'] = $gamesForWeek;
        $hasGamesForWeek = count($gamesForWeek) > 0;
        $data['hasGamesForWeek'] = $hasGamesForWeek;

        $dateOfGame = Games::select('date_for_week')->where('week', '=', $this->currentWeek)->groupBy('date_for_week')->get();
        $data['dateOfGame'] = $dateOfGame;
        $gamesUserIsPlaying = Selections::where('user_id', "=", $user->id)->groupBy("game_id")->get();
        $data['gamesUserIsPlaying'] = $gamesUserIsPlaying;
        $playingIn = [];
        foreach ($gamesUserIsPlaying as $game) {
            $playingIn[] =  "$game->game_id";
        }
        $data['playingIn'] = $playingIn;

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
