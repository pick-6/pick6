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
    public function __construct()
    {
        $this->middleware('auth');
    }


    // TO DO: get current/last 'week' number dynamically 
    public function index()
    {
        $user = \Auth::user();

        // Games for the Week
        $gamesForWeek = Games::where('week', '=', '2')->get();
        $dateOfGame = Games::where('week', '=', '2')->groupBy('date_for_week')->get();
        $gamesUserIsPlaying = Selections::where('user_id', "=", $user->id)->groupBy("game_id")->get();
        $playingIn = [];
        foreach ($gamesUserIsPlaying as $game) {
            $playingIn[] =  "$game->game_id";
        }

        // My Current Games
        $myCurrentGames = Selections::select('home', 'away', 'game_id')->join('games', 'selections.game_id', '=', 'games.id')->where('user_id', "=", $user->id)->where('games.week', '=', '2')->get();
        $hasCurrentGames = count($myCurrentGames) > 0;

        // Last Week's Results
        $lastWeekResults = Games::select('*')->join('users', 'games.winning_user', '=', 'users.id')->where('games.week', '=', '1')->get();

        // Leaderboard
        $leaderboard = Games::select(DB::raw('winning_user, first_name, last_name, avatar, count(winning_user) AS wins'))->join('users', 'games.winning_user', '=', 'users.id')->groupBy('winning_user')->orderBy(DB::raw('count(winning_user)'), 'DESC')->get();


        $data = [];
        $data['user'] = $user;
        $data['gamesForWeek'] = $gamesForWeek;
        $data['dateOfGame'] = $dateOfGame;
        $data['gamesUserIsPlaying'] = $gamesUserIsPlaying;
        $data['playingIn'] = $playingIn;
        $data['hasCurrentGames'] = $hasCurrentGames;
        $data['myCurrentGames'] = $myCurrentGames;
        $data['lastWeekResults'] = $lastWeekResults;
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
        $existingUser->password = bcrypt($request->password);
        $existingUser->save();
        return redirect()->action('AccountController@index');
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
        return redirect()->action('AccountController@index');
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
        return redirect('/account');
    }

    public function destroy($id)
    {
        abort(404);
    }
}
